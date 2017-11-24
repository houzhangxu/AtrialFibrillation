<div class="form-horizontal form-view">

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">姓名:</label>

                <div class="controls">

                    <span class="text">{{ $user["name"] ? $user["name"] : "无" }}</span>

                </div>

            </div>

        </div>

        <!--/span-->

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="Email">Email:</label>

                <div class="controls">
                    <span class="text">{{ $user["email"] ? $user["email"] : "无" }}</span>
                </div>

            </div>

        </div>

        <!--/span-->

    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="permissions">用户角色:</label>

                <div class="controls">
                    <span class="text">
                    @foreach($user->roles as $key => $roles)
                            <span class="label label-success">{{ $roles["name"] }}</span>
                        @endforeach
                    </span>
                </div>

            </div>

        </div>

        <!--/span-->

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="permissions">用户权限:</label>

                <div class="controls">
                    <span class="text">
                    @foreach($user->permissions as $key => $permission)
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

                    <span class="text">{{ isset($user["updated_at"]) ? $user["updated_at"] : "无" }}</span>

                </div>

            </div>

        </div>

        <!--/span-->

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">创建时间:</label>

                <div class="controls">

                    <span class="text">{{ isset($user["created_at"]) ? $user["created_at"] : "无" }}</span>

                </div>

            </div>

        </div>

        <!--/span-->

    </div>


</div>