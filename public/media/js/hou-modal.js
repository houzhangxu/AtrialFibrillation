var Hmodal = function (){
    var dialog = function (config){
        $('body').modalmanager('loading');
        var url = config.url;
        var title = config.title;
        var $modal = $("#ajax-modal");

        $modal.find(".modal-header h3").html(title);        //设置标题

        if(config.width){       //设置宽度
            $modal.attr("data-width",config.width);
        }

        if (config.buttons instanceof Array) {      //设置按钮
            var footer = $('.modal-footer');
            footer.html("");
            if (config.buttons instanceof Array) {
                $.each(config.buttons,
                    function(i, btn) {
                        var obtn = document.createElement("button");
                        with(obtn) {
                            type = "button";
                            className = btn.className;
                            onclick = function() {
                                btn.click.call($modal);
                            };
                            innerHTML = btn.inner;
                            //setAttribute("disabled", "disabled")
                        }
                        footer.append(obtn)
                    })
            }
        }

        $modal.find(".modal-body").load(url, '', function(){
            $modal.modal();
        });
        return $modal;

    };
    var form = function (a) {
        function b(e) {
            if (typeof e.id != "string") {
                throw new UndefinedException("表单ID不能为空")
            } else {
                if (!e.id.startsWith("#")) {
                    throw new UndefinedException("配置属性ID必须由“#”开头")
                }
            }
            var f = $(e.id);
            //var error1 = $('.alert-error', f);
            //var success1 = $('.alert-success', f);

            if (e.validable) {
                console.log(e);
                var g = $('<div class="alert alert-success hide"><button class="close" data-dismiss="alert"></button>验证成功. </div>');
                c.prepend(g);
                var d = $('<div class="alert alert-error hide"><button class="close" data-dismiss="alert"></button>验证失败. </div>');
                c.prepend(d);
                f.validate({
                    errorElement: "span",
                    errorClass: "help-block help-block-error",
                    focusInvalid: false,
                    ignore: "",
                    messages: e.messages,
                    rules: e.rules,
                    inlineValidation: true,
                    invalidHandler: function(i, h) {
                        g.hide();
                        d.show();
                        App.scrollTo(d, -200)
                    },
                    errorPlacement: function(h, i) {
                        if (i.is(":checkbox")) {
                            h.insertAfter(i.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"))
                        } else {
                            if (i.is(":radio")) {
                                h.insertAfter(i.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"))
                            } else {
                                h.insertAfter(i)
                            }
                        }
                    },
                    highlight: function (element) { // hightlight error inputs
                        $(element)
                            .closest('.help-inline').removeClass('ok'); // display OK icon
                        $(element)
                            .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
                    },

                    unhighlight: function (element) { // revert the change dony by hightlight
                        $(element)
                            .closest('.control-group').removeClass('error'); // set error class to the control group
                    },
                    success: function (label) {
                        label
                            .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                            .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
                    },
                    submitHandler: function(h) {
                        g.show();
                        d.hide()
                    }
                })
            }
            this.submit = function(l, n) {
                console.log(e);
                if (e.validable && !f.valid()) {
                    return false
                }
                var o = {};
                if (typeof e.befSubmit == "function") {
                    var k = e.befSubmit(o);
                    if (typeof k == "boolean" && !k) {
                        return false
                    }
                }
                var h = new FormData(f[0]);
                for (var p in o) {
                    h.append(p, o[p])
                }
                var m = function(q) {
                    if (q.success) {
                        if (typeof e.success == "function") {
                            e.success(q)
                        }
                    } else {
                        if (typeof e.failure == "function") {
                            e.failure(q)
                        }
                    }
                };
                var j = f.attr("action");
                alert(j);
                //var i = Render.Loading(f);
                $.ajax({
                    async: false,
                    type: "POST",
                    url: j,
                    data: h,
                    timeout: 6000,
                    cache: false,
                    traditional: true,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                    },
                    success: function(q) {
                        if (l && typeof l == "function") {
                            l(q)
                        }
                        if (typeof e.autotip != "boolean" || e.autotip) {
                            //messager.alert("提&#8194;示", q.message,
                            //    function() {
                            //        m(q)
                            //    })

                            alert("提示:" + q.message);
                            m(q);
                        } else {
                            m(q)
                        }
                        if (n && typeof n == "function") {
                            n(q)
                        }
                    },
                    error: function(r, s, q) {
                        alert("出错了");
                    }
                })
            };
            return this
        }
        return new b(a);
    };

    var formAJAX = function (form_config){

        var oForm = $(form_config.id);

        //oForm.find("select, input:checkbox, input:radio, input:file").uniform();
        oForm.find("input:checkbox, input:radio, input:file").uniform();
        if (jQuery().datepicker) {
            oForm.find('.date-picker').datepicker({
                format: oForm.find('.date-picker').attr("data-date-format"),
                autoclose: true
            });
        }

        if (jQuery().timepicker) {
            oForm.find('.timepicker-default').timepicker();
            oForm.find('.timepicker-24').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false
            });
        }

        var success1 = $('<div class="alert alert-success hide"><button class="close" data-dismiss="alert"></button>验证成功. </div>');
        var error1 = $('<div class="alert alert-error hide"><button class="close" data-dismiss="alert"></button>验证失败. </div>');
        oForm.prepend(error1);
        oForm.prepend(success1);

        oForm.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-inline', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: form_config["rules"],
            messages: form_config["messages"],
            invalidHandler: function (event, validator) { //display error alert on form submit
                success1.hide();
                error1.show();
                toastr.error("验证失败,请检查数据.");
                App.scrollTo(error1, -200);
            },

            errorPlacement: function(error, element) {
                if (element.attr("type") == "checkbox") {
                    error.insertAfter(element.closest(".controls"))
                } else {
                    if (element.attr("type") == "radio") {
                        error.insertAfter(element.closest(".controls"))
                    } else {
                        error.insertAfter(element)
                    }
                }
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.help-inline').removeClass('ok'); // display OK icon
                $(element)
                    .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change dony by hightlight
                $(element)
                    .closest('.control-group').removeClass('error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                    .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
            },

            submitHandler: function (form) {
                success1.show();
                error1.hide();
                var h = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: form.action,
                    data: h,
                    timeout: 6000,
                    cache: false,
                    traditional: true,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                    },
                    success: function(result) {
                        if(result.code == 1){
                            $("#ajax-modal").modal('hide');
                            toastr.success(result.message);
                        }else if(result.code == 0){
                            toastr.error(result.message);
                        }else{
                            toastr.error("服务器错误,请联系管理员.");
                        }
                        /*
                        if (l && typeof l == "function") {
                            l(q)
                        }
                        if (typeof e.autotip != "boolean" || e.autotip) {
                            //messager.alert("提&#8194;示", q.message,
                            //    function() {
                            //        m(q)
                            //    })

                            alert("提示:" + q.message);
                            m(q);
                        } else {
                            m(q)
                        }
                        if (n && typeof n == "function") {
                            n(q)
                        }
                        */
                    },
                    error: function(r, s, q) {
                        toastr.error("提交数据出现错误,请联系管理员.");
                        // alert("出错了");
                    }
                })
            }
        });

        return oForm;
    };
    
    var recordDelete = function (config) {
        var id = config.id;
        var url = config.url;
        var Table = config.Table;

        if(confirm("确认删除吗?")){
            $.ajax({
                async: false,
                type: "GET",
                url: url,
                data: {
                    ids:id
                },
                timeout: 6000,
                cache: false,
                traditional: true,
                processData: true,
                beforeSend: function() {
                },
                success: function(result) {
                    if(result.code == 1){
                        Table.fnDraw();
                        toastr.success(result.message);
                    }else if(result.code == 2){
                        toastr.error(result.message);
                    }else{
                        toastr.error("服务器出现错误.");
                    }
                },
                error: function(r, s, q) {
                    toastr.error("提交数据出现错误,请联系管理员.");
                    // alert("出错了");
                }
            })
        }

    };

    var select2 = function (config){
        var select = $(config.id);
        var url = config.url;
        var data = [];

        $.ajax({
            type:'get',
            url:url,
            async:false,
            success:function(response){
                console.log(response);
                data = response;
            }
        });
        select.select2({
            //tags: ["AF", "冠心病", "脑卒中", "高血压", "糖尿病"],
            tags: true,
            data: data
        });
    };
    //http://localhost/AtrialFibrillation/public/family?uid=1
    //http://localhost/AtrialFibrillation/public/family/option/DISEASE
    return {
        dialog:function (config){
            return dialog(config);
        },
        form:function (a) {
            return form(a);
        },
        formAJAX: function (form_config) {
            return formAJAX(form_config);
        },
        delete: function (config) {
            return recordDelete(config);
        },
        select2: function (config) {
            return select2(config);
        }
        
    }
}();