<form id="form-add" action="{{ url("account/create") }}" class="horizontal-form">
    <!--
    <div class="alert alert-error hide">

        <button class="close" data-dismiss="alert"></button>

        You have some form errors. Please check below.

    </div>

    <div class="alert alert-success hide">

        <button class="close" data-dismiss="alert"></button>

        Your form validation is successful!

    </div>
    -->
    <h3 class="form-section">账户</h3>
    {{ csrf_field() }}
    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="username"><span class="required">*</span> 用户名</label>

                <div class="controls">

                    <input type="text" id="username" name="Account[username]" class="m-wrap span12" placeholder="username">

                </div>

            </div>

        </div>

        <!--/span-->

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="password"><span class="required">*</span> Password</label>

                <div class="controls">

                    <input type="password" id="password" name="Account[password]" class="m-wrap span12" placeholder="">

                </div>

            </div>

        </div>

        <!--/span-->

    </div>

    <!--/row-->

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label"><span class="required">*</span> 性别</label>

                <div class="controls">
                    @foreach($account->sex() as $key => $value)
                        <label class="radio">
                            <input type="radio" name="Account[sex]" value="{{ $key }}" />
                            {{ $value }}
                        </label>
                    @endforeach
                    <!--
                    <select class="m-wrap span12" name="Account[sex]" id="sex">

                        <option value="1">Male</option>

                        <option value="0">Female</option>

                    </select>
                    -->
                </div>

            </div>

        </div>

    </div>

</form>

<script>
    /*
    var oForm_add = Hmodal.form({
        id: '#form-add',
        messages: {
            "Account[username]": {
                required: '用户名不能为空',
                minlength: '用户名必须为6位以上'
            },
            password: {
                required: '密码不能为空',
                minlength: '密码必须为6位以上'
            },
            sex: {
                required: '性别不能为空'
            }

        },
        rules: {
            username	  : {
                minlength: 6,
                required: true
            },
            password	  : {
                minlength: 6,
                required: true
            },
            sex	  : { required: true }
        },
        befSubmit: function(data) {
        }
    });
    */
    var oForm_add = Hmodal.formAJAX({
        id: "#form-add",
        messages: {
            "Account[username]": {
                required: '用户名不能为空',
                minlength: '用户名必须为6位以上'
            },
            "Account[password]": {
                required: '密码不能为空',
                minlength: '密码必须为6位以上'
            },
            "Account[sex]": {
                required: '性别不能为空'
            }

        },
        rules: {
            "Account[username]"	  : {
                minlength: 6,
                required: true
            },
            "Account[password]"	  : {
                minlength: 6,
                required: true
            },
            "Account[sex]"	  : { required: true }
        }

    });
    /*
    var oForm_add = $("#form-add");
    console.log(oForm_add);
    var error1 = $('.alert-error', oForm_add);
    var success1 = $('.alert-success', oForm_add);

    oForm_add.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-inline', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
            username: {
                minlength: 6,
                required: true
            },
            password: {
                required: true,
                minlength: 6
            },
            sex: {
                required: true
            }
        },

        invalidHandler: function (event, validator) { //display error alert on form submit
            success1.hide();
            error1.show();
            App.scrollTo(error1, -200);
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
        }
    });
    */
</script>

<!--
<script>
    $("#formID").validationEngine({
        validationEventTriggers:"blur",  //触发的事件  validationEventTriggers:"keyup blur",
        inlineValidation: true,//是否即时验证，false为提交表单时验证,默认true
        success :  false,//为true时即使有不符合的也提交表单,false表示只有全部通过验证了才能提交表单,默认false
        promptPosition: "bottomLeft",//提示所在的位置，topLeft, topRight, bottomLeft,  centerRight, bottomRight
        failure : function() { alert("验证失败，请检查。");  },//验证失败时调用的函数
        success : function() { callSuccessFunction() }//验证通过时调用的函数
    });
</script>
-->