<div class="form-horizontal form-view">

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">名称:</label>

                <div class="controls">

                    <span class="text">{{ $model["name"] ? $model["name"] : "无" }}</span>

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">路由地址:</label>

                <div class="controls">

                    <span class="text">{{ $model["route"] ? $model["route"] : "无" }}</span>

                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="">更新时间:</label>

                <div class="controls">

                    <span class="text">{{ isset($model["updated_at"]) ? $model["updated_at"] : "无" }}</span>

                </div>

            </div>

        </div>

        <!--/span-->

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">创建时间:</label>

                <div class="controls">

                    <span class="text">{{ isset($model["created_at"]) ? $model["created_at"] : "无" }}</span>

                </div>

            </div>

        </div>

        <!--/span-->

    </div>


</div>