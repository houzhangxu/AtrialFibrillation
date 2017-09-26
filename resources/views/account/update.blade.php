<form id="form-update" action="{{ url("account/modify") }}/{{ $account["id"] }}" class="horizontal-form">
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

                    <input type="text" id="username" name="Account[username]" class="m-wrap span12" placeholder="username" value="{{ $account["username"] }}">

                </div>

            </div>

        </div>

        <!--/span-->

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="password"><span class="required">*</span> Password</label>

                <div class="controls">

                    <input type="password" id="password" name="Account[password]" class="m-wrap span12" value="{{ $account["password"] }}" placeholder="">

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
                            <input type="radio" name="Account[sex]" {{ $account["sex"] == $key ? "checked" : "" }} value="{{ $key }}" />
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
    <inpu type="hidden" name="Account[id]" value="{{ $account["id"] }}" />
</form>

<script>
    var oForm_update = Hmodal.formAJAX({
        id: "#form-update",
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
</script>