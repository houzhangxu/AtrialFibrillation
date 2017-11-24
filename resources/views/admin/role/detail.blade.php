<div class="form-horizontal form-view">

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">角色名称:</label>

                <div class="controls">

                    <span class="text">{{ $role["name"] ? $role["name"] : "无" }}</span>

                </div>

            </div>

        </div>

        <!--/span-->

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="permissions">角色权限:</label>

                <div class="controls">
                    <span class="text">
                    @foreach($role->permissions as $key => $permission)
                        <span class="label label-success">{{ $permission["name"] }}</span>
                    @endforeach
                    </span>
                </div>

            </div>

        </div>

        <!--/span-->

    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="">更新时间:</label>

                <div class="controls">

                    <span class="text">{{ isset($role["updated_at"]) ? $role["updated_at"] : "无" }}</span>

                </div>

            </div>

        </div>

        <!--/span-->

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">创建时间:</label>

                <div class="controls">

                    <span class="text">{{ isset($role["created_at"]) ? $role["created_at"] : "无" }}</span>

                </div>

            </div>

        </div>

        <!--/span-->

    </div>


</div>