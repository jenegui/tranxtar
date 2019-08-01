(function($) {
    "use strict";
    var methods = {init: function(options) {
            var form = this;
            if (!form.data('jqv') || form.data('jqv') == null) {
                options = methods._saveOptions(form, options);
                $(document).on("click", ".formError", function() {
                    $(this).fadeOut(150, function() {
                        $(this).parent('.formErrorOuter').remove();
                        $(this).remove();
                    });
                });
            }
            return this;
        }, attach: function(userOptions) {
            var form = this;
            var options;
            if (userOptions)
                options = methods._saveOptions(form, userOptions);
            else
                options = form.data('jqv');
            options.validateAttribute = (form.find("[data-validation-engine*=validate]").length) ? "data-validation-engine" : "class";
            if (options.binded) {
                form.on(options.validationEventTrigger, "[" + options.validateAttribute + "*=validate]:not([type=checkbox]):not([type=radio]):not(.datepicker)", methods._onFieldEvent);
                form.on("click", "[" + options.validateAttribute + "*=validate][type=checkbox],[" + options.validateAttribute + "*=validate][type=radio]", methods._onFieldEvent);
                form.on(options.validationEventTrigger, "[" + options.validateAttribute + "*=validate][class*=datepicker]", {"delay": 300}, methods._onFieldEvent);
            }
            if (options.autoPositionUpdate) {
                $(window).bind("resize", {"noAnimation": true, "formElem": form}, methods.updatePromptsPosition);
            }
            form.on("click", "a[data-validation-engine-skip], a[class*='validate-skip'], button[data-validation-engine-skip], button[class*='validate-skip'], input[data-validation-engine-skip], input[class*='validate-skip']", methods._submitButtonClick);
            form.removeData('jqv_submitButton');
            form.on("submit", methods._onSubmitEvent);
            return this;
        }, detach: function() {
            var form = this;
            var options = form.data('jqv');
            form.find("[" + options.validateAttribute + "*=validate]").not("[type=checkbox]").off(options.validationEventTrigger, methods._onFieldEvent);
            form.find("[" + options.validateAttribute + "*=validate][type=checkbox],[class*=validate][type=radio]").off("click", methods._onFieldEvent);
            form.off("submit", methods._onSubmitEvent);
            form.removeData('jqv');
            form.off("click", "a[data-validation-engine-skip], a[class*='validate-skip'], button[data-validation-engine-skip], button[class*='validate-skip'], input[data-validation-engine-skip], input[class*='validate-skip']", methods._submitButtonClick);
            form.removeData('jqv_submitButton');
            if (options.autoPositionUpdate)
                $(window).off("resize", methods.updatePromptsPosition);
            return this;
        }, validate: function() {
            var element = $(this);
            var valid = null;
            if (element.is("form") || element.hasClass("validationEngineContainer")) {
                if (element.hasClass('validating')) {
                    return false;
                } else {
                    element.addClass('validating');
                    var options = element.data('jqv');
                    var valid = methods._validateFields(this);
                    setTimeout(function() {
                        element.removeClass('validating');
                    }, 100);
                    if (valid && options.onSuccess) {
                        options.onSuccess();
                    } else if (!valid && options.onFailure) {
                        options.onFailure();
                    }
                }
            } else if (element.is('form') || element.hasClass('validationEngineContainer')) {
                element.removeClass('validating');
            } else {
                var form = element.closest('form, .validationEngineContainer'), options = (form.data('jqv')) ? form.data('jqv') : $.validationEngine.defaults, valid = methods._validateField(element, options);
                if (valid && options.onFieldSuccess)
                    options.onFieldSuccess();
                else if (options.onFieldFailure && options.InvalidFields.length > 0) {
                    options.onFieldFailure();
                }
            }
            if (options.onValidationComplete) {
                return!!options.onValidationComplete(form, valid);
            }
            return valid;
        }, updatePromptsPosition: function(event) {
            if (event && this == window) {
                var form = event.data.formElem;
                var noAnimation = event.data.noAnimation;
            }
            else
                var form = $(this.closest('form, .validationEngineContainer'));
            var options = form.data('jqv');
            form.find('[' + options.validateAttribute + '*=validate]').not(":disabled").each(function() {
                var field = $(this);
                if (options.prettySelect && field.is(":hidden"))
                    field = form.find("#" + options.usePrefix + field.attr('id') + options.useSuffix);
                var prompt = methods._getPrompt(field);
                var promptText = $(prompt).find(".formErrorContent").html();
                if (prompt)
                    methods._updatePrompt(field, $(prompt), promptText, undefined, false, options, noAnimation);
            });
            return this;
        }, showPrompt: function(promptText, type, promptPosition, showArrow) {
            var form = this.closest('form, .validationEngineContainer');
            var options = form.data('jqv');
            if (!options)
                options = methods._saveOptions(this, options);
            if (promptPosition)
                options.promptPosition = promptPosition;
            options.showArrow = showArrow == true;
            methods._showPrompt(this, promptText, type, false, options);
            return this;
        }, hide: function() {
            var form = $(this).closest('form, .validationEngineContainer');
            var options = form.data('jqv');
            var fadeDuration = (options && options.fadeDuration) ? options.fadeDuration : 0.3;
            var closingtag;
            if ($(this).is("form") || $(this).hasClass("validationEngineContainer")) {
                closingtag = "parentForm" + methods._getClassName($(this).attr("id"));
            } else {
                closingtag = methods._getClassName($(this).attr("id")) + "formError";
            }
            $('.' + closingtag).fadeTo(fadeDuration, 0.3, function() {
                $(this).parent('.formErrorOuter').remove();
                $(this).remove();
            });
            return this;
        }, hideAll: function() {
            var form = this;
            var options = form.data('jqv');
            var duration = options ? options.fadeDuration : 300;
            $('.formError').fadeTo(duration, 300, function() {
                $(this).parent('.formErrorOuter').remove();
                $(this).remove();
            });
            return this;
        }, _onFieldEvent: function(event) {
            var field = $(this);
            var form = field.closest('form, .validationEngineContainer');
            var options = form.data('jqv');
            options.eventTrigger = "field";
            window.setTimeout(function() {
                methods._validateField(field, options);
                if (options.InvalidFields.length === 0 && options.onFieldSuccess) {
                    options.onFieldSuccess();
                } else if (options.InvalidFields.length > 0 && options.onFieldFailure) {
                    options.onFieldFailure();
                }
            }, (event.data) ? event.data.delay : 0);
        }, _onSubmitEvent: function() {
            var form = $(this);
            var options = form.data('jqv');
            if (form.data("jqv_submitButton")) {
                var submitButton = $("#" + form.data("jqv_submitButton"));
                if (submitButton) {
                    if (submitButton.length > 0) {
                        if (submitButton.hasClass("validate-skip") || submitButton.attr("data-validation-engine-skip") == "true")
                            return true;
                    }
                }
            }
            options.eventTrigger = "submit";
            var r = methods._validateFields(form);
            if (r && options.ajaxFormValidation) {
                methods._validateFormWithAjax(form, options);
                return false;
            }
            if (options.onValidationComplete) {
                return!!options.onValidationComplete(form, r);
            }
            return r;
        }, _checkAjaxStatus: function(options) {
            var status = true;
            $.each(options.ajaxValidCache, function(key, value) {
                if (!value) {
                    status = false;
                    return false;
                }
            });
            return status;
        }, _checkAjaxFieldStatus: function(fieldid, options) {
            return options.ajaxValidCache[fieldid] == true;
        }, _validateFields: function(form) {
            var options = form.data('jqv');
            var errorFound = false;
            form.trigger("jqv.form.validating");
            var first_err = null;
            form.find('[' + options.validateAttribute + '*=validate]').not(":disabled").each(function() {
                var field = $(this);
                var names = [];
                if ($.inArray(field.attr('name'), names) < 0) {
                    errorFound |= methods._validateField(field, options);
                    if (errorFound && first_err == null)
                        if (field.is(":hidden") && options.prettySelect)
                            first_err = field = form.find("#" + options.usePrefix + methods._jqSelector(field.attr('id')) + options.useSuffix);
                        else {
                            if (field.data('jqv-prompt-at')instanceof jQuery) {
                                field = field.data('jqv-prompt-at');
                            } else if (field.data('jqv-prompt-at')) {
                                field = $(field.data('jqv-prompt-at'));
                            }
                            first_err = field;
                        }
                    if (options.doNotShowAllErrosOnSubmit)
                        return false;
                    names.push(field.attr('name'));
                    if (options.showOneMessage == true && errorFound) {
                        return false;
                    }
                }
            });
            form.trigger("jqv.form.result", [errorFound]);
            if (errorFound) {
                if (options.scroll) {
                    var destination = first_err.offset().top;
                    var fixleft = first_err.offset().left;
                    var positionType = options.promptPosition;
                    if (typeof(positionType) == 'string' && positionType.indexOf(":") != -1)
                        positionType = positionType.substring(0, positionType.indexOf(":"));
                    if (positionType != "bottomRight" && positionType != "bottomLeft") {
                        var prompt_err = methods._getPrompt(first_err);
                        if (prompt_err) {
                            destination = prompt_err.offset().top;
                        }
                    }
                    if (options.scrollOffset) {
                        destination -= options.scrollOffset;
                    }
                    if (options.isOverflown) {
                        var overflowDIV = $(options.overflownDIV);
                        if (!overflowDIV.length)
                            return false;
                        var scrollContainerScroll = overflowDIV.scrollTop();
                        var scrollContainerPos = -parseInt(overflowDIV.offset().top);
                        destination += scrollContainerScroll + scrollContainerPos - 5;
                        var scrollContainer = $(options.overflownDIV + ":not(:animated)");
                        scrollContainer.animate({scrollTop: destination}, 1100, function() {
                            if (options.focusFirstField)
                                first_err.focus();
                        });
                    } else {
                        $("html, body").animate({scrollTop: destination}, 1100, function() {
                            if (options.focusFirstField)
                                first_err.focus();
                        });
                        $("html, body").animate({scrollLeft: fixleft}, 1100)
                    }
                } else if (options.focusFirstField)
                    first_err.focus();
                return false;
            }
            return true;
        }, _validateFormWithAjax: function(form, options) {
            var data = form.serialize();
            var type = (options.ajaxFormValidationMethod) ? options.ajaxFormValidationMethod : "GET";
            var url = (options.ajaxFormValidationURL) ? options.ajaxFormValidationURL : form.attr("action");
            var dataType = (options.dataType) ? options.dataType : "json";
            $.ajax({type: type, url: url, cache: false, dataType: dataType, data: data, form: form, methods: methods, options: options, beforeSend: function() {
                    return options.onBeforeAjaxFormValidation(form, options);
                }, error: function(data, transport) {
                    methods._ajaxError(data, transport);
                }, success: function(json) {
                    if ((dataType == "json") && (json !== true)) {
                        var errorInForm = false;
                        for (var i = 0; i < json.length; i++) {
                            var value = json[i];
                            var errorFieldId = value[0];
                            var errorField = $($("#" + errorFieldId)[0]);
                            if (errorField.length == 1) {
                                var msg = value[2];
                                if (value[1] == true) {
                                    if (msg == "" || !msg) {
                                        methods._closePrompt(errorField);
                                    } else {
                                        if (options.allrules[msg]) {
                                            var txt = options.allrules[msg].alertTextOk;
                                            if (txt)
                                                msg = txt;
                                        }
                                        if (options.showPrompts)
                                            methods._showPrompt(errorField, msg, "pass", false, options, true);
                                    }
                                } else {
                                    errorInForm |= true;
                                    if (options.allrules[msg]) {
                                        var txt = options.allrules[msg].alertText;
                                        if (txt)
                                            msg = txt;
                                    }
                                    if (options.showPrompts)
                                        methods._showPrompt(errorField, msg, "", false, options, true);
                                }
                            }
                        }
                        options.onAjaxFormComplete(!errorInForm, form, json, options);
                    } else
                        options.onAjaxFormComplete(true, form, json, options);
                }});
        }, _validateField: function(field, options, skipAjaxValidation) {
            if (!field.attr("id")) {
                field.attr("id", "form-validation-field-" + $.validationEngine.fieldIdCounter);
                ++$.validationEngine.fieldIdCounter;
            }
            if (!options.validateNonVisibleFields && (field.is(":hidden") && !options.prettySelect || field.parent().is(":hidden")))
                return false;
            var rulesParsing = field.attr(options.validateAttribute);
            var getRules = /validate\[(.*)\]/.exec(rulesParsing);
            if (!getRules)
                return false;
            var str = getRules[1];
            var rules = str.split(/\[|,|\]/);
            var isAjaxValidator = false;
            var fieldName = field.attr("name");
            var promptText = "";
            var promptType = "";
            var required = false;
            var limitErrors = false;
            options.isError = false;
            options.showArrow = true;
            if (options.maxErrorsPerField > 0) {
                limitErrors = true;
            }
            var form = $(field.closest("form, .validationEngineContainer"));
            for (var i = 0; i < rules.length; i++) {
                rules[i] = rules[i].replace(" ", "");
                if (rules[i] === '') {
                    delete rules[i];
                }
            }
            for (var i = 0, field_errors = 0; i < rules.length; i++) {
                if (limitErrors && field_errors >= options.maxErrorsPerField) {
                    if (!required) {
                        var have_required = $.inArray('required', rules);
                        required = (have_required != -1 && have_required >= i);
                    }
                    break;
                }
                var errorMsg = undefined;
                switch (rules[i]) {
                    case"required":
                        required = true;
                        errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._required);
                        break;
                    case"custom":
                        errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._custom);
                        break;
                    case"groupRequired":
                        var classGroup = "[" + options.validateAttribute + "*=" + rules[i + 1] + "]";
                        var firstOfGroup = form.find(classGroup).eq(0);
                        if (firstOfGroup[0] != field[0]) {
                            methods._validateField(firstOfGroup, options, skipAjaxValidation);
                            options.showArrow = true;
                        }
                        errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._groupRequired);
                        if (errorMsg)
                            required = true;
                        options.showArrow = false;
                        break;
                    case"ajax":
                        errorMsg = methods._ajax(field, rules, i, options);
                        if (errorMsg) {
                            promptType = "load";
                        }
                        break;
                    case"minSize":
                        errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._minSize);
                        break;
                    case"maxSize":
                        errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._maxSize);
                        break;
                    case"min":
                        errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._min);
                        break;
                    case"max":
                        errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._max);
                        break;
                    case"past":
                        errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._past);
                        break;
                    case"future":
                        errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._future);
                        break;
                    case"dateRange":
                        var classGroup = "[" + options.validateAttribute + "*=" + rules[i + 1] + "]";
                        options.firstOfGroup = form.find(classGroup).eq(0);
                        options.secondOfGroup = form.find(classGroup).eq(1);
                        if (options.firstOfGroup[0].value || options.secondOfGroup[0].value) {
                            errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._dateRange);
                        }
                        if (errorMsg)
                            required = true;
                        options.showArrow = false;
                        break;
                    case"dateTimeRange":
                        var classGroup = "[" + options.validateAttribute + "*=" + rules[i + 1] + "]";
                        options.firstOfGroup = form.find(classGroup).eq(0);
                        options.secondOfGroup = form.find(classGroup).eq(1);
                        if (options.firstOfGroup[0].value || options.secondOfGroup[0].value) {
                            errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._dateTimeRange);
                        }
                        if (errorMsg)
                            required = true;
                        options.showArrow = false;
                        break;
                    case"maxCheckbox":
                        field = $(form.find("input[name='" + fieldName + "']"));
                        errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._maxCheckbox);
                        break;
                    case"minCheckbox":
                        field = $(form.find("input[name='" + fieldName + "']"));
                        errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._minCheckbox);
                        break;
                    case"equals":
                        errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._equals);
                        break;
                    case"funcCall":
                        errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._funcCall);
                        break;
                    case"creditCard":
                        errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._creditCard);
                        break;
                    case"condRequired":
                        errorMsg = methods._getErrorMessage(form, field, rules[i], rules, i, options, methods._condRequired);
                        if (errorMsg !== undefined) {
                            required = true;
                        }
                        break;
                    case "maxListOptions":
                        errorMsg = methods._maxListOptions(field, rules, i, options);
                        field = $($("select[name='" + fieldName + "']"));
                        break;
                    case "minListOptions":
                        errorMsg = methods._minListOptions(field, rules, i, options);
                        field = $($("select[name='" + fieldName + "']"));
                        break;
                    case "checkDuplicate":
                        errorMsg = methods._checkDuplicate(field, rules, i, options);
                        break;    
                    default:
                }
                var end_validation = false;
                if (typeof errorMsg == "object") {
                    switch (errorMsg.status) {
                        case"_break":
                            end_validation = true;
                            break;
                        case"_error":
                            errorMsg = errorMsg.message;
                            break;
                        case"_error_no_prompt":
                            return true;
                            break;
                        default:
                            break;
                        }
                }
                if (end_validation) {
                    break;
                }
                if (typeof errorMsg == 'string') {
                    promptText += errorMsg + "<br/>";
                    options.isError = true;
                    field_errors++;
                }
            }
            if (!required && !(field.val()) && field.val().length < 1)
                options.isError = false;
            var fieldType = field.prop("type");
            var positionType = field.data("promptPosition") || options.promptPosition;
            if ((fieldType == "radio" || fieldType == "checkbox") && form.find("input[name='" + fieldName + "']").size() > 1) {
                if (positionType === 'inline') {
                    field = $(form.find("input[name='" + fieldName + "'][type!=hidden]:last"));
                } else {
                    field = $(form.find("input[name='" + fieldName + "'][type!=hidden]:first"));
                }
                options.showArrow = false;
            }
            if (field.is(":hidden") && options.prettySelect) {
                field = form.find("#" + options.usePrefix + methods._jqSelector(field.attr('id')) + options.useSuffix);
            }
            if (options.isError && options.showPrompts) {
                methods._showPrompt(field, promptText, promptType, false, options);
            } else {
                if (!isAjaxValidator)
                    methods._closePrompt(field);
            }
            if (!isAjaxValidator) {
                field.trigger("jqv.field.result", [field, options.isError, promptText]);
            }
            var errindex = $.inArray(field[0], options.InvalidFields);
            if (errindex == -1) {
                if (options.isError)
                    options.InvalidFields.push(field[0]);
            } else if (!options.isError) {
                options.InvalidFields.splice(errindex, 1);
            }
            methods._handleStatusCssClasses(field, options);
            if (options.isError && options.onFieldFailure)
                options.onFieldFailure(field);
            if (!options.isError && options.onFieldSuccess)
                options.onFieldSuccess(field);
            return options.isError;
        }, _handleStatusCssClasses: function(field, options) {
            if (options.addSuccessCssClassToField)
                field.removeClass(options.addSuccessCssClassToField);
            if (options.addFailureCssClassToField)
                field.removeClass(options.addFailureCssClassToField);
            if (options.addSuccessCssClassToField && !options.isError)
                field.addClass(options.addSuccessCssClassToField);
            if (options.addFailureCssClassToField && options.isError)
                field.addClass(options.addFailureCssClassToField);
        }, _getErrorMessage: function(form, field, rule, rules, i, options, originalValidationMethod) {
            var rule_index = jQuery.inArray(rule, rules);
            if (rule === "custom" || rule === "funcCall") {
                var custom_validation_type = rules[rule_index + 1];
                rule = rule + "[" + custom_validation_type + "]";
                delete(rules[rule_index]);
            }
            var alteredRule = rule;
            var element_classes = (field.attr("data-validation-engine")) ? field.attr("data-validation-engine") : field.attr("class");
            var element_classes_array = element_classes.split(" ");
            var errorMsg;
            if (rule == "future" || rule == "past" || rule == "maxCheckbox" || rule == "minCheckbox") {
                errorMsg = originalValidationMethod(form, field, rules, i, options);
            } else {
                errorMsg = originalValidationMethod(field, rules, i, options);
            }
            if (errorMsg != undefined) {
                var custom_message = methods._getCustomErrorMessage($(field), element_classes_array, alteredRule, options);
                if (custom_message)
                    errorMsg = custom_message;
            }
            return errorMsg;
        }, _getCustomErrorMessage: function(field, classes, rule, options) {
            var custom_message = false;
            var validityProp = /^custom\[.*\]$/.test(rule) ? methods._validityProp["custom"] : methods._validityProp[rule];
            if (validityProp != undefined) {
                custom_message = field.attr("data-errormessage-" + validityProp);
                if (custom_message != undefined)
                    return custom_message;
            }
            custom_message = field.attr("data-errormessage");
            if (custom_message != undefined)
                return custom_message;
            var id = '#' + field.attr("id");
            if (typeof options.custom_error_messages[id] != "undefined" && typeof options.custom_error_messages[id][rule] != "undefined") {
                custom_message = options.custom_error_messages[id][rule]['message'];
            } else if (classes.length > 0) {
                for (var i = 0; i < classes.length && classes.length > 0; i++) {
                    var element_class = "." + classes[i];
                    if (typeof options.custom_error_messages[element_class] != "undefined" && typeof options.custom_error_messages[element_class][rule] != "undefined") {
                        custom_message = options.custom_error_messages[element_class][rule]['message'];
                        break;
                    }
                }
            }
            if (!custom_message && typeof options.custom_error_messages[rule] != "undefined" && typeof options.custom_error_messages[rule]['message'] != "undefined") {
                custom_message = options.custom_error_messages[rule]['message'];
            }
            return custom_message;
        }, _validityProp: {"required": "value-missing", "custom": "custom-error", "groupRequired": "value-missing", "ajax": "custom-error", "minSize": "range-underflow", "maxSize": "range-overflow", "min": "range-underflow", "max": "range-overflow", "past": "type-mismatch", "future": "type-mismatch", "dateRange": "type-mismatch", "dateTimeRange": "type-mismatch", "maxCheckbox": "range-overflow", "minCheckbox": "range-underflow", "equals": "pattern-mismatch", "funcCall": "custom-error", "creditCard": "pattern-mismatch", "condRequired": "value-missing"}, _required: function(field, rules, i, options, condRequired) {
            switch (field.prop("type")) {
                case"text":
                case"password":
                case"textarea":
                case"file":
                case"select-one":
                case"select-multiple":
                default:
                    var field_val = $.trim(field.val());
                    var dv_placeholder = $.trim(field.attr("data-validation-placeholder"));
                    var placeholder = $.trim(field.attr("placeholder"));
                    if ((!field_val) || (dv_placeholder && field_val == dv_placeholder) || (placeholder && field_val == placeholder)) {
                        return options.allrules[rules[i]].alertText;
                    }
                    break;
                case"radio":
                case"checkbox":
                    if (condRequired) {
                        if (!field.attr('checked')) {
                            return options.allrules[rules[i]].alertTextCheckboxMultiple;
                        }
                        break;
                    }
                    var form = field.closest("form, .validationEngineContainer");
                    var name = field.attr("name");
                    if (form.find("input[name='" + name + "']:checked").size() == 0) {
                        if (form.find("input[name='" + name + "']:visible").size() == 1)
                            return options.allrules[rules[i]].alertTextCheckboxe;
                        else
                            return options.allrules[rules[i]].alertTextCheckboxMultiple;
                    }
                    break;
                }
        }, _groupRequired: function(field, rules, i, options) {
            var classGroup = "[" + options.validateAttribute + "*=" + rules[i + 1] + "]";
            var isValid = false;
            field.closest("form, .validationEngineContainer").find(classGroup).each(function() {
                if (!methods._required($(this), rules, i, options)) {
                    isValid = true;
                    return false;
                }
            });
            if (!isValid) {
                return options.allrules[rules[i]].alertText;
            }
        }, _custom: function(field, rules, i, options) {
            var customRule = rules[i + 1];
            var rule = options.allrules[customRule];
            var fn;
            if (!rule) {
                alert("jqv:custom rule not found - " + customRule);
                return;
            }
            if (rule["regex"]) {
                var ex = rule.regex;
                if (!ex) {
                    alert("jqv:custom regex not found - " + customRule);
                    return;
                }
                var pattern = new RegExp(ex);
                if (!pattern.test(field.val()))
                    return options.allrules[customRule].alertText;
            } else if (rule["func"]) {
                fn = rule["func"];
                if (typeof(fn) !== "function") {
                    alert("jqv:custom parameter 'function' is no function - " + customRule);
                    return;
                }
                if (!fn(field, rules, i, options))
                    return options.allrules[customRule].alertText;
            } else {
                alert("jqv:custom type not allowed " + customRule);
                return;
            }
        }, _funcCall: function(field, rules, i, options) {
            var functionName = rules[i + 1];
            var fn;
            if (functionName.indexOf('.') > -1)
            {
                var namespaces = functionName.split('.');
                var scope = window;
                while (namespaces.length)
                {
                    scope = scope[namespaces.shift()];
                }
                fn = scope;
            }
            else
                fn = window[functionName] || options.customFunctions[functionName];
            if (typeof(fn) == 'function')
                return fn(field, rules, i, options);
        }, _equals: function(field, rules, i, options) {
            var equalsField = rules[i + 1];
            if (field.val() != $("#" + equalsField).val())
                return options.allrules.equals.alertText;
        }, _maxSize: function(field, rules, i, options) {
            var max = rules[i + 1];
            var len = field.val().length;
            if (len > max) {
                var rule = options.allrules.maxSize;
                return rule.alertText + max + rule.alertText2;
            }
        }, _minSize: function(field, rules, i, options) {
            var min = rules[i + 1];
            var len = field.val().length;
            if (len < min) {
                var rule = options.allrules.minSize;
                return rule.alertText + min + rule.alertText2;
            }
        }, _min: function(field, rules, i, options) {
            var min = parseFloat(rules[i + 1]);
            var len = parseFloat(field.val());
            if (len < min) {
                var rule = options.allrules.min;
                if (rule.alertText2)
                    return rule.alertText + min + rule.alertText2;
                return rule.alertText + min;
            }
        }, _max: function(field, rules, i, options) {
            var max = parseFloat(rules[i + 1]);
            var len = parseFloat(field.val());
            if (len > max) {
                var rule = options.allrules.max;
                if (rule.alertText2)
                    return rule.alertText + max + rule.alertText2;
                return rule.alertText + max;
            }
        }, _past: function(form, field, rules, i, options) {
            var p = rules[i + 1];
            var fieldAlt = $(form.find("input[name='" + p.replace(/^#+/, '') + "']"));
            var pdate;
            if (p.toLowerCase() == "now") {
                pdate = new Date();
            } else if (undefined != fieldAlt.val()) {
                if (fieldAlt.is(":disabled"))
                    return;
                pdate = methods._parseDate(fieldAlt.val());
            } else {
                pdate = methods._parseDate(p);
            }
            var vdate = methods._parseDate(field.val());
            if (vdate > pdate) {
                var rule = options.allrules.past;
                if (rule.alertText2)
                    return rule.alertText + methods._dateToString(pdate) + rule.alertText2;
                return rule.alertText + methods._dateToString(pdate);
            }
        }, _future: function(form, field, rules, i, options) {
            var p = rules[i + 1];
            var fieldAlt = $(form.find("input[name='" + p.replace(/^#+/, '') + "']"));
            var pdate;
            if (p.toLowerCase() == "now") {
                pdate = new Date();
            } else if (undefined != fieldAlt.val()) {
                if (fieldAlt.is(":disabled"))
                    return;
                pdate = methods._parseDate(fieldAlt.val());
            } else {
                pdate = methods._parseDate(p);
            }
            var vdate = methods._parseDate(field.val());
            if (vdate < pdate) {
                var rule = options.allrules.future;
                if (rule.alertText2)
                    return rule.alertText + methods._dateToString(pdate) + rule.alertText2;
                return rule.alertText + methods._dateToString(pdate);
            }
        }, _isDate: function(value) {
            var dateRegEx = new RegExp(/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(?:(?:0?[1-9]|1[0-2])(\/|-)(?:0?[1-9]|1\d|2[0-8]))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(0?2(\/|-)29)(\/|-)(?:(?:0[48]00|[13579][26]00|[2468][048]00)|(?:\d\d)?(?:0[48]|[2468][048]|[13579][26]))$/);
            return dateRegEx.test(value);
        }, _isDateTime: function(value) {
            var dateTimeRegEx = new RegExp(/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1}$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^((1[012]|0?[1-9]){1}\/(0?[1-9]|[12][0-9]|3[01]){1}\/\d{2,4}\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1})$/);
            return dateTimeRegEx.test(value);
        }, _dateCompare: function(start, end) {
            return(new Date(start.toString()) < new Date(end.toString()));
        }, _dateRange: function(field, rules, i, options) {
            if ((!options.firstOfGroup[0].value && options.secondOfGroup[0].value) || (options.firstOfGroup[0].value && !options.secondOfGroup[0].value)) {
                return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;
            }
            if (!methods._isDate(options.firstOfGroup[0].value) || !methods._isDate(options.secondOfGroup[0].value)) {
                return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;
            }
            if (!methods._dateCompare(options.firstOfGroup[0].value, options.secondOfGroup[0].value)) {
                return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;
            }
        }, _dateTimeRange: function(field, rules, i, options) {
            if ((!options.firstOfGroup[0].value && options.secondOfGroup[0].value) || (options.firstOfGroup[0].value && !options.secondOfGroup[0].value)) {
                return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;
            }
            if (!methods._isDateTime(options.firstOfGroup[0].value) || !methods._isDateTime(options.secondOfGroup[0].value)) {
                return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;
            }
            if (!methods._dateCompare(options.firstOfGroup[0].value, options.secondOfGroup[0].value)) {
                return options.allrules[rules[i]].alertText + options.allrules[rules[i]].alertText2;
            }
        }, _maxCheckbox: function(form, field, rules, i, options) {
            var nbCheck = rules[i + 1];
            var groupname = field.attr("name");
            var groupSize = form.find("input[name='" + groupname + "']:checked").size();
            if (groupSize > nbCheck) {
                options.showArrow = false;
                if (options.allrules.maxCheckbox.alertText2)
                    return options.allrules.maxCheckbox.alertText + " " + nbCheck + " " + options.allrules.maxCheckbox.alertText2;
                return options.allrules.maxCheckbox.alertText;
            }
        }, _minCheckbox: function(form, field, rules, i, options) {
            var nbCheck = rules[i + 1];
            var groupname = field.attr("name");
            var groupSize = form.find("input[name='" + groupname + "']:checked").size();
            if (groupSize < nbCheck) {
                options.showArrow = false;
                return options.allrules.minCheckbox.alertText + " " + nbCheck + " " + options.allrules.minCheckbox.alertText2;
            }
        }, _creditCard: function(field, rules, i, options) {
            var valid = false, cardNumber = field.val().replace(/ +/g, '').replace(/-+/g, '');
            var numDigits = cardNumber.length;
            if (numDigits >= 14 && numDigits <= 16 && parseInt(cardNumber) > 0) {
                var sum = 0, i = numDigits - 1, pos = 1, digit, luhn = new String();
                do {
                    digit = parseInt(cardNumber.charAt(i));
                    luhn += (pos++ % 2 == 0) ? digit * 2 : digit;
                } while (--i >= 0)
                for (i = 0; i < luhn.length; i++) {
                    sum += parseInt(luhn.charAt(i));
                }
                valid = sum % 10 == 0;
            }
            if (!valid)
                return options.allrules.creditCard.alertText;
        }, _ajax: function(field, rules, i, options) {
            var errorSelector = rules[i + 1];
            var rule = options.allrules[errorSelector];
            var extraData = rule.extraData;
            var extraDataDynamic = rule.extraDataDynamic;
            var data = {"fieldId": field.attr("id"), "fieldValue": field.val()};
            if (typeof extraData === "object") {
                $.extend(data, extraData);
            } else if (typeof extraData === "string") {
                var tempData = extraData.split("&");
                for (var i = 0; i < tempData.length; i++) {
                    var values = tempData[i].split("=");
                    if (values[0] && values[0]) {
                        data[values[0]] = values[1];
                    }
                }
            }
            if (extraDataDynamic) {
                var tmpData = [];
                var domIds = String(extraDataDynamic).split(",");
                for (var i = 0; i < domIds.length; i++) {
                    var id = domIds[i];
                    if ($(id).length) {
                        var inputValue = field.closest("form, .validationEngineContainer").find(id).val();
                        var keyValue = id.replace('#', '') + '=' + escape(inputValue);
                        data[id.replace('#', '')] = inputValue;
                    }
                }
            }
            if (options.eventTrigger == "field") {
                delete(options.ajaxValidCache[field.attr("id")]);
            }
            if (!options.isError && !methods._checkAjaxFieldStatus(field.attr("id"), options)) {
                $.ajax({type: options.ajaxFormValidationMethod, url: rule.url, cache: false, dataType: "json", data: data, field: field, rule: rule, methods: methods, options: options, beforeSend: function() {
                    }, error: function(data, transport) {
                        methods._ajaxError(data, transport);
                    }, success: function(json) {
                        var errorFieldId = json[0];
                        var errorField = $("#" + errorFieldId).eq(0);
                        if (errorField.length == 1) {
                            var status = json[1];
                            var msg = json[2];
                            if (!status) {
                                options.ajaxValidCache[errorFieldId] = false;
                                options.isError = true;
                                if (msg) {
                                    if (options.allrules[msg]) {
                                        var txt = options.allrules[msg].alertText;
                                        if (txt) {
                                            msg = txt;
                                        }
                                    }
                                }
                                else
                                    msg = rule.alertText;
                                if (options.showPrompts)
                                    methods._showPrompt(errorField, msg, "", true, options);
                            } else {
                                options.ajaxValidCache[errorFieldId] = true;
                                if (msg) {
                                    if (options.allrules[msg]) {
                                        var txt = options.allrules[msg].alertTextOk;
                                        if (txt) {
                                            msg = txt;
                                        }
                                    }
                                }
                                else
                                    msg = rule.alertTextOk;
                                if (options.showPrompts) {
                                    if (msg)
                                        methods._showPrompt(errorField, msg, "pass", true, options);
                                    else
                                        methods._closePrompt(errorField);
                                }
                                if (options.eventTrigger == "submit")
                                    field.closest("form").submit();
                            }
                        }
                        errorField.trigger("jqv.field.result", [errorField, options.isError, msg]);
                    }});
                return rule.alertTextLoad;
            }
        }, _ajaxError: function(data, transport) {
            if (data.status == 0 && transport == null)
                alert("The page is not served from a server! ajax call failed");
            else if (typeof console != "undefined")
                console.log("Ajax error: " + data.status + " " + transport);
        }, _dateToString: function(date) {
            return date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
        }, _parseDate: function(d) {
            var dateParts = d.split("-");
            if (dateParts == d)
                dateParts = d.split("/");
            if (dateParts == d) {
                dateParts = d.split(".");
                return new Date(dateParts[2], (dateParts[1] - 1), dateParts[0]);
            }
            return new Date(dateParts[0], (dateParts[1] - 1), dateParts[2]);
        }, _showPrompt: function(field, promptText, type, ajaxed, options, ajaxform) {
            if (field.data('jqv-prompt-at')instanceof jQuery) {
                field = field.data('jqv-prompt-at');
            } else if (field.data('jqv-prompt-at')) {
                field = $(field.data('jqv-prompt-at'));
            }
            var prompt = methods._getPrompt(field);
            if (ajaxform)
                prompt = false;
            if ($.trim(promptText)) {
                if (prompt)
                    methods._updatePrompt(field, prompt, promptText, type, ajaxed, options);
                else
                    methods._buildPrompt(field, promptText, type, ajaxed, options);
            }
        }, _buildPrompt: function(field, promptText, type, ajaxed, options) {
            var prompt = $('<div>');
            prompt.addClass(methods._getClassName(field.attr("id")) + "formError");
            prompt.addClass("parentForm" + methods._getClassName(field.closest('form, .validationEngineContainer').attr("id")));
            prompt.addClass("formError");
            switch (type) {
                case"pass":
                    prompt.addClass("greenPopup");
                    break;
                case"load":
                    prompt.addClass("blackPopup");
                    break;
                default:
            }
            if (ajaxed)
                prompt.addClass("ajaxed");
            var promptContent = $('<div>').addClass("formErrorContent").html(promptText).appendTo(prompt);
            var positionType = field.data("promptPosition") || options.promptPosition;
            if (options.showArrow) {
                var arrow = $('<div>').addClass("formErrorArrow");
                if (typeof(positionType) == 'string')
                {
                    var pos = positionType.indexOf(":");
                    if (pos != -1)
                        positionType = positionType.substring(0, pos);
                }
                switch (positionType) {
                    case"bottomLeft":
                    case"bottomRight":
                        prompt.find(".formErrorContent").before(arrow);
                        arrow.addClass("formErrorArrowBottom").html('<div class="line1"><!-- --></div><div class="line2"><!-- --></div><div class="line3"><!-- --></div><div class="line4"><!-- --></div><div class="line5"><!-- --></div><div class="line6"><!-- --></div><div class="line7"><!-- --></div><div class="line8"><!-- --></div><div class="line9"><!-- --></div><div class="line10"><!-- --></div>');
                        break;
                    case"topLeft":
                    case"topRight":
                        arrow.html('<div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div>');
                        prompt.append(arrow);
                        break;
                    }
            }
            if (options.addPromptClass)
                prompt.addClass(options.addPromptClass);
            var requiredOverride = field.attr('data-required-class');
            if (requiredOverride !== undefined) {
                prompt.addClass(requiredOverride);
            } else {
                if (options.prettySelect) {
                    if ($('#' + field.attr('id')).next().is('select')) {
                        var prettyOverrideClass = $('#' + field.attr('id').substr(options.usePrefix.length).substring(options.useSuffix.length)).attr('data-required-class');
                        if (prettyOverrideClass !== undefined) {
                            prompt.addClass(prettyOverrideClass);
                        }
                    }
                }
            }
            prompt.css({"opacity": 0});
            if (positionType === 'inline') {
                prompt.addClass("inline");
                if (typeof field.attr('data-prompt-target') !== 'undefined' && $('#' + field.attr('data-prompt-target')).length > 0) {
                    prompt.appendTo($('#' + field.attr('data-prompt-target')));
                } else {
                    field.after(prompt);
                }
            } else {
                field.before(prompt);
            }
            var pos = methods._calculatePosition(field, prompt, options);
            prompt.css({'position': positionType === 'inline' ? 'relative' : 'absolute', "top": pos.callerTopPosition, "left": pos.callerleftPosition, "marginTop": pos.marginTopSize, "opacity": 0}).data("callerField", field);
            if (options.autoHidePrompt) {
                setTimeout(function() {
                    prompt.animate({"opacity": 0}, function() {
                        prompt.closest('.formErrorOuter').remove();
                        prompt.remove();
                    });
                }, options.autoHideDelay);
            }
            return prompt.animate({"opacity": 0.87});
        }, _updatePrompt: function(field, prompt, promptText, type, ajaxed, options, noAnimation) {
            if (prompt) {
                if (typeof type !== "undefined") {
                    if (type == "pass")
                        prompt.addClass("greenPopup");
                    else
                        prompt.removeClass("greenPopup");
                    if (type == "load")
                        prompt.addClass("blackPopup");
                    else
                        prompt.removeClass("blackPopup");
                }
                if (ajaxed)
                    prompt.addClass("ajaxed");
                else
                    prompt.removeClass("ajaxed");
                prompt.find(".formErrorContent").html(promptText);
                var pos = methods._calculatePosition(field, prompt, options);
                var css = {"top": pos.callerTopPosition, "left": pos.callerleftPosition, "marginTop": pos.marginTopSize};
                if (noAnimation)
                    prompt.css(css);
                else
                    prompt.animate(css);
            }
        }, _closePrompt: function(field) {
            var prompt = methods._getPrompt(field);
            if (prompt)
                prompt.fadeTo("fast", 0, function() {
                    prompt.parent('.formErrorOuter').remove();
                    prompt.remove();
                });
        }, closePrompt: function(field) {
            return methods._closePrompt(field);
        }, _getPrompt: function(field) {
            var formId = $(field).closest('form, .validationEngineContainer').attr('id');
            var className = methods._getClassName(field.attr("id")) + "formError";
            var match = $("." + methods._escapeExpression(className) + '.parentForm' + methods._getClassName(formId))[0];
            if (match)
                return $(match);
        }, _escapeExpression: function(selector) {
            return selector.replace(/([#;&,\.\+\*\~':"\!\^$\[\]\(\)=>\|])/g, "\\$1");
        }, isRTL: function(field)
        {
            var $document = $(document);
            var $body = $('body');
            var rtl = (field && field.hasClass('rtl')) || (field && (field.attr('dir') || '').toLowerCase() === 'rtl') || $document.hasClass('rtl') || ($document.attr('dir') || '').toLowerCase() === 'rtl' || $body.hasClass('rtl') || ($body.attr('dir') || '').toLowerCase() === 'rtl';
            return Boolean(rtl);
        }, _calculatePosition: function(field, promptElmt, options) {
            var promptTopPosition, promptleftPosition, marginTopSize;
            var fieldWidth = field.width();
            var fieldLeft = field.position().left;
            var fieldTop = field.position().top;
            var fieldHeight = field.height();
            var promptHeight = promptElmt.height();
            promptTopPosition = promptleftPosition = 0;
            marginTopSize = -promptHeight;
            var positionType = field.data("promptPosition") || options.promptPosition;
            var shift1 = "";
            var shift2 = "";
            var shiftX = 0;
            var shiftY = 0;
            if (typeof(positionType) == 'string') {
                if (positionType.indexOf(":") != -1) {
                    shift1 = positionType.substring(positionType.indexOf(":") + 1);
                    positionType = positionType.substring(0, positionType.indexOf(":"));
                    if (shift1.indexOf(",") != -1) {
                        shift2 = shift1.substring(shift1.indexOf(",") + 1);
                        shift1 = shift1.substring(0, shift1.indexOf(","));
                        shiftY = parseInt(shift2);
                        if (isNaN(shiftY))
                            shiftY = 0;
                    }
                    ;
                    shiftX = parseInt(shift1);
                    if (isNaN(shift1))
                        shift1 = 0;
                }
                ;
            }
            ;
            switch (positionType) {
                default:
                case"topRight":
                    promptleftPosition += fieldLeft + fieldWidth - 30;
                    promptTopPosition += fieldTop;
                    break;
                case"topLeft":
                    promptTopPosition += fieldTop;
                    promptleftPosition += fieldLeft;
                    break;
                case"centerRight":
                    promptTopPosition = fieldTop + 4;
                    marginTopSize = 0;
                    promptleftPosition = fieldLeft + field.outerWidth(true) + 5;
                    break;
                case"centerLeft":
                    promptleftPosition = fieldLeft - (promptElmt.width() + 2);
                    promptTopPosition = fieldTop + 4;
                    marginTopSize = 0;
                    break;
                case"bottomLeft":
                    promptTopPosition = fieldTop + field.height() + 5;
                    marginTopSize = 0;
                    promptleftPosition = fieldLeft;
                    break;
                case"bottomRight":
                    promptleftPosition = fieldLeft + fieldWidth - 30;
                    promptTopPosition = fieldTop + field.height() + 5;
                    marginTopSize = 0;
                    break;
                case"inline":
                    promptleftPosition = 0;
                    promptTopPosition = 0;
                    marginTopSize = 0;
            }
            ;
            promptleftPosition += shiftX;
            promptTopPosition += shiftY;
            return{"callerTopPosition": promptTopPosition + "px", "callerleftPosition": promptleftPosition + "px", "marginTopSize": marginTopSize + "px"};
        }, _saveOptions: function(form, options) {
            if ($.validationEngineLanguage)
                var allRules = $.validationEngineLanguage.allRules;
            else
                $.error("jQuery.validationEngine rules are not loaded, plz add localization files to the page");
            $.validationEngine.defaults.allrules = allRules;
            var userOptions = $.extend(true, {}, $.validationEngine.defaults, options);
            form.data('jqv', userOptions);
            return userOptions;
        }, _getClassName: function(className) {
            if (className)
                return className.replace(/:/g, "_").replace(/\./g, "_");
        }, _jqSelector: function(str) {
            return str.replace(/([;&,\.\+\*\~':"\!\^#$%@\[\]\(\)=>\|])/g, '\\$1');
        }, _condRequired: function(field, rules, i, options) {
            var idx, dependingField;
            for (idx = (i + 1); idx < rules.length; idx++) {
                dependingField = jQuery("#" + rules[idx]).first();
                if (dependingField.length && methods._required(dependingField, ["required"], 0, options, true) == undefined) {
                    return methods._required(field, ["required"], 0, options);
                }
            }
        },_maxListOptions: function(field, rules, i, options) {
            var listItems = rules[i + 1];
            var groupname = field.attr("name");
            var groupSize = $("select[name='" + groupname + "'] option:selected").size();
            if (groupSize > listItems) {
              var rule = options.allrules.maxListOptions;
              return rule.alertText + listItems + rule.alertText2;
            }
          },

          _minListOptions: function(field, rules, i, options) {
            var listItems = rules[i + 1];
            var groupname = field.attr("name");
            var groupSize = $("select[name='" + groupname + "'] option:selected").size();
            if (groupSize < listItems) {
              var rule = options.allrules.minListOptions;
              return rule.alertText + listItems + rule.alertText2;
            }
          },

          _checkDuplicate: function(field, rules, i, options) {
            var equalsField = rules[i + 1];
            if (field.attr('value') == $("#" + equalsField).attr('value'))
              return options.allrules.checkDuplicate.alertText;
          }, _submitButtonClick: function(event) {
            var button = $(this);
            var form = button.closest('form, .validationEngineContainer');
            form.data("jqv_submitButton", button.attr("id"));
        }};
    $.fn.validationEngine = function(method) {
        var form = $(this);
        if (!form[0])
            return form;
        if (typeof(method) == 'string' && method.charAt(0) != '_' && methods[method]) {
            if (method != "showPrompt" && method != "hide" && method != "hideAll")
                methods.init.apply(form);
            return methods[method].apply(form, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method == 'object' || !method) {
            methods.init.apply(form, arguments);
            return methods.attach.apply(form);
        } else {
            $.error('Method ' + method + ' does not exist in jQuery.validationEngine');
        }
    };
    $.validationEngine = {fieldIdCounter: 0, defaults: {validationEventTrigger: "blur", scroll: true, focusFirstField: true, showPrompts: true, validateNonVisibleFields: false, promptPosition: "topRight", bindMethod: "bind", inlineAjax: false, ajaxFormValidation: false, ajaxFormValidationURL: false, ajaxFormValidationMethod: 'get', onAjaxFormComplete: $.noop, onBeforeAjaxFormValidation: $.noop, onValidationComplete: false, doNotShowAllErrosOnSubmit: false, custom_error_messages: {}, binded: true, showArrow: true, isError: false, maxErrorsPerField: false, ajaxValidCache: {}, autoPositionUpdate: false, InvalidFields: [], onFieldSuccess: false, onFieldFailure: false, onSuccess: false, onFailure: false, validateAttribute: "class", addSuccessCssClassToField: "", addFailureCssClassToField: "", autoHidePrompt: false, autoHideDelay: 10000, fadeDuration: 0.3, prettySelect: false, addPromptClass: "", usePrefix: "", useSuffix: "", showOneMessage: false}};
    $(function() {
        $.validationEngine.defaults.promptPosition = methods.isRTL() ? 'topLeft' : "topRight"
    });
})(jQuery);