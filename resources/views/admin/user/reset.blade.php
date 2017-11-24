<form id="form-reset" action="{{ url("admin/user/reset") }}/{{$id}}" class="horizontal-form">
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
    <h3 class="form-section">用户信息</h3>
    {{ csrf_field() }}

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="password"><span class="required">*</span> 密码</label>

                <div class="controls">

                    <input type="text" id="password" name="User[password]" class="m-wrap span12" placeholder="密码">

                </div>

            </div>

        </div>

    </div>

</form>

<script>
    var oForm_reset = Hmodal.formAJAX({
        id: "#form-reset",
        messages: {
            "User[password]": {
                required: '密码不能为空'
            }
        },
        rules: {
            "User[password]": {
                required: true
            }
        }

    });

</script>