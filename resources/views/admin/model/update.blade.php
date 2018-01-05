<form id="form-update" action="{{ url("admin/model/update") }}/{{$id}}" class="horizontal-form">
    <h3 class="form-section">模块</h3>
    {{ csrf_field() }}
    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="name"><span class="required">*</span> 名称</label>

                <div class="controls">

                    <input type="text" id="name" name="Model[name]" class="m-wrap span12" placeholder="名称" value="{{$model["name"]}}">

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="route"><span class="required">*</span> 路由地址</label>

                <div class="controls">

                    <input type="text" id="route" name="Model[route]" class="m-wrap span12" placeholder="路由地址" value="{{$model["route"]}}">

                </div>

            </div>

        </div>

    </div>

</form>

<script>
    var oForm_update = Hmodal.formAJAX({
        id: "#form-update",
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