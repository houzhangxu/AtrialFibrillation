<div class="form-horizontal form-view">

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">权限名称:</label>

                <div class="controls">

                    <span class="text">{{ $permission["name"] ? $permission["name"] : "无" }}</span>

                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="">更新时间:</label>

                <div class="controls">

                    <span class="text">{{ isset($permission["updated_at"]) ? $permission["updated_at"] : "无" }}</span>

                </div>

            </div>

        </div>

        <!--/span-->

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">创建时间:</label>

                <div class="controls">

                    <span class="text">{{ isset($permission["created_at"]) ? $permission["created_at"] : "无" }}</span>

                </div>

            </div>

        </div>

        <!--/span-->

    </div>


</div>