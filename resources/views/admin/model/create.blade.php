<form id="form-add" action="{{ url("admin/model/create/".$pid) }}" class="horizontal-form">
    <h3 class="form-section">模块管理</h3>
    {{ csrf_field() }}
    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="name"><span class="required">*</span> 名称</label>

                <div class="controls">

                    <input type="text" id="name" name="Model[name]" class="m-wrap span12" placeholder="名称">

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="route"><span class="required">*</span> 路由地址</label>

                <div class="controls">

                    <input type="text" id="route" name="Model[route]" class="m-wrap span12" placeholder="路由地址">

                </div>

            </div>

        </div>

    </div>

</form>

<script>
    var oForm_add = Hmodal.formAJAX({
        id: "#form-add",
        messages: {
            "Model[name]": {
                required: '名称不能为空'
            }
        },
        rules: {
            "Model[name]"	  : {
                required: true
            }
        }
    });
</script>