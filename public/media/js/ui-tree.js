var UITree = function () {

    return {
        //main function to initiate the module
        init: function () {

            //This is a quick example of capturing the select event on tree leaves, not branches
/*
            $("#tree_1").on("nodeselect.tree.data-api", "[data-role=leaf]", function (e) {  //叶子节点选择
                var output = "";

                output += "Node nodeselect_leaf event fired:\n";
                output += "Node Type: leaf\n";
                output += "Value: " + ((e.node.value) ? e.node.value : e.node.el.text()) + "\n";
                output += "Parentage: " + e.node.parentage.join("/");

                alert(output);
            });
*/
            //This is a quick example of capturing the select event on tree branches, not leaves
            /*
            $("#tree_1").on("nodeselect.tree.data-api", "[role=branch]", function (e) { //分支节点选择
                var output = "Node nodeselect_branch event fired:\n"; + "Node Type: branch\n" + "Value: " + ((e.node.value) ? e.node.value : e.node.el.text()) + "\n" + "Parentage: " + e.node.parentage.join("/") + "\n"

                alert(output);
            });
            */

            //Listening for the 'openbranch' event. Look for e.node, which is the actual node the user opens
            /*
            $("#tree_1").on("openbranch.tree", "[data-toggle=branch]", function (e) {   //打开主分支
                alert("111");
                var output = "Node openbranch event fired:\n" + "Node Type: branch\n" + "Value: " + ((e.node.value) ? e.node.value : e.node.el.text()) + "\n" + "Parentage: " + e.node.parentage.join("/") + "\n"

                alert(output);
            });
            */

            //Listening for the 'closebranch' event. Look for e.node, which is the actual node the user closed

            /*
            $("#tree_1").on("closebranch.tree", "[data-toggle=branch]", function (e) {  //关闭主分支

                var output = "Node closebranch event fired:\n" + "Node Type: branch\n" + "Value: " + ((e.node.value) ? e.node.value : e.node.el.text()) + "\n" + "Parentage: " + e.node.parentage.join("/") + "\n"

                alert(output);
            });
            */
        }

    };

}();