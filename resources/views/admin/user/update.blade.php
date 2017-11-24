<form id="form-update" action="{{ url("admin/user/update") }}/{{$id}}" class="horizontal-form">
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

                <label class="control-label" for="name"><span class="required">*</span> 姓名</label>

                <div class="controls">

                    <input type="text" id="name" name="User[name]" class="m-wrap span12" placeholder="姓名" value="{{ $user["name"] }}">

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="email"><span class="required">*</span> Email</label>

                <div class="controls">

                    <input type="text" id="email" name="User[email]" class="m-wrap span12" placeholder="Email" value="{{ $user["email"] }}">

                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="role"><span class="required"></span> 角色</label>

                <div class="controls">

                    <input type="hidden" id="role" name="role" class="span12 select2" value="{{ $roles }}">

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="permissions"><span class="required"></span> 权限</label>

                <div class="controls">

                    <input type="hidden" id="permissions" name="permissions" class="span12 select2" value="{{ $permissions }}">

                </div>

            </div>

        </div>

    </div>

</form>

<script>
    var oForm_update = Hmodal.formAJAX({
        id: "#form-update",
        messages: {
            "User[name]": {
                required: '姓名不能为空'
            },
            "User[email]": {
                required: 'email不能为空',
                email: '邮箱格式不正确'
            },
            "User[password]": {
                required: '密码不能为空'
            }
        },
        rules: {
            "User[name]"	  : {
                required: true
            },
            "User[email]"	  : {
                required: true,
                email:true
            },
            "User[password]": {
                required: true
            }
        }

    });

    Hmodal.select2({    //加载角色列表
        id:"#role",
        url: "{{ route("admin.role.list") }}"
    });

    Hmodal.select2({    //加载权限列表
        id:"#permissions",
        url: "{{ route("admin.permissions.list") }}"
    });

</script>