
$(function() {
    $('#tree').treeview({
        data: getTree(), //节点数据
        enableLinks: true,
    });
})

function getTree() {
    //节点上的数据遵循如下的格式：
    var tree = [{
        text: "系统首页", //节点显示的文本值  string
        // icon: "glyphicon glyphicon-play-circle", //节点上显示的图标，支持bootstrap的图标  string
        // selectedIcon: "glyphicon glyphicon-ok", //节点被选中时显示的图标       string
        // color: "#ff0000", //节点的前景色      string
        // backColor: "#1606ec", //节点的背景色      string
        href: "/index/index", //节点上的超链接
        selectable: true, //标记节点是否可以选择。false表示节点应该作为扩展标题，不会触发选择事件。  string
        state: { //描述节点的初始状态    Object
            checked: true, //是否选中节点
            disabled: false, //是否禁用节点
            expanded: false, //是否展开节点
            selected: true //是否选中节点
        }
    }, {
        text: "工程管理",
        state: {
            expanded: false,
        },
        nodes: [{
            text: "Child 2",
        }, {
            text: "Child 2"
        }]
    }, {
        text: "工种管理",
        state: {
            expanded: false,
        },
        nodes: [{
            text: "Child 2",
        }, {
            text: "Child 2"
        }]
    }, {
        text: "经销商管理",
        state: {
            expanded: false,
        },
        nodes: [{
            text: "Child 2",
        }, {
            text: "Child 2"
        }]
    }, {
        text: "材料管理",
        state: {
            expanded: false,
        },
        nodes: [{
            text: "Child 2",
        }, {
            text: "Child 2"
        }]
    }, {
        text: "财务管理",
        state: {
            expanded: false,
        },
        nodes: [{
            text: "Child 2",
        }, {
            text: "Child 2"
        }]
    }, {
        text: "系统管理",
        selectable: true,
        href: "/system/index",
        nodes: [{
            text: "用户列表",
            selectable: false,
            href: "/system/index",
        }, {
            text: "修改密码",
            selectable: false,
            href: "/system/changepwd",
        }]
    }];

    return tree;
}