<form id="form-add" action="{{ url("admin/cae/create") }}" class="horizontal-form">
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
    <h3 class="form-section">中英文字段</h3>
    {{ csrf_field() }}
    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="name"><span class="required">*</span> 中文名称</label>

                <div class="controls">

                    <input type="text" id="name" name="Permissions[name]" class="m-wrap span12" placeholder="权限名称">

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="name"><span class="required">*</span> 英文名称</label>

                <div class="controls">

                    <input type="text" id="name" name="CAE[name]" class="m-wrap span12" placeholder="权限名称">

                </div>

            </div>

        </div>

    </div>

</form>

<script>
    var oForm_add = Hmodal.formAJAX({
        id: "#form-add",
        messages: {
            "CAE[name]": {
                required: '权限名称不能为空'
            }
        },
        rules: {
            "CAE[name]"	  : {
                required: true
            }
        }

    });
</script>