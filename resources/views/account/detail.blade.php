<div class="form-horizontal form-view">
<div class="row-fluid">
    <div class="span6 ">

        <div class="control-group">

            <label class="control-label" for="firstName">用户名:</label>

            <div class="controls">

                <span class="text">{{ $account["username"] }}</span>

            </div>

        </div>

    </div>

    <!--/span-->

    <div class="span6 ">

        <div class="control-group">

            <label class="control-label" for="lastName">密码:</label>

            <div class="controls">

                <span class="text">{{ $account["password"] }}</span>

            </div>

        </div>

    </div>

    <!--/span-->

    <div class="span6 ">

        <div class="control-group">

            <label class="control-label" for="lastName">性别:</label>

            <div class="controls">
                <span class="text">{{ $account->sex($account["sex"]) }}</span>
            </div>

        </div>

    </div>

</div>
</div>