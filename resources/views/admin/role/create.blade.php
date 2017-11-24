<form id="form-add" action="{{ url("admin/role/create") }}" class="horizontal-form">
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
    <h3 class="form-section">角色</h3>
    {{ csrf_field() }}
    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="name"><span class="required">*</span> 角色名称</label>

                <div class="controls">

                    <input type="text" id="name" name="Role[name]" class="m-wrap span12" placeholder="角色名称">

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="permissions"><span class="required"></span> 权限</label>

                <div class="controls">

                    <input type="hidden" id="permissions" name="permissions" class="span12 select2" value="">

                </div>

            </div>

        </div>

    </div>

</form>

<script>
    var oForm_add = Hmodal.formAJAX({
        id: "#form-add",
        messages: {
            "Role[name]": {
                required: '角色名称不能为空'
            }
        },
        rules: {
            "Role[name]"	  : {
                required: true
            }
        }

    });

    Hmodal.select2({
        id:"#permissions",
        url: "{{ route("admin.permissions.list") }}"

    });

</script>