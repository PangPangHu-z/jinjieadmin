define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'information.contacts/index',
        add_url: 'information.contacts/add',
        edit_url: 'information.contacts/edit',
        delete_url: 'information.contacts/delete',
        export_url: 'information.contacts/export',
        modify_url: 'information.contacts/modify',
        stock_url: 'information.contacts/stock',
    };

    var Controller = {

        index: function () {
            ea.table.render({
                init: init,
                toolbar: ['refresh',
                    [{
                        text: '添加',
                        url: init.add_url,
                        method: 'open',
                        auth: 'add',
                        class: 'layui-btn layui-btn-normal layui-btn-sm',
                        icon: 'fa fa-plus ',
                        extend: 'data-full="true"',
                    }],
                    'delete'],
                cols: [[
                    {type: "checkbox"},
                    {field: 'id', width: 80, title: 'ID'},
                    {field: 'name', width: 100, title: '联系人名称'},
                    {field: 'sex',width: 80,title: '性别'},
                    {field: 'phone', minWidth: 80, title: '手机号'},
                    {field: 'mobile', minWidth: 80, title: '座机/传真'},
                    {field: 'email', minWidth: 80, title: '邮箱'},
                    {field: 'type',width: 100,title: '联系人类型'},
                    {field: 'is_leader',width: 100,title: '首要联系人'},
                    {field: 'create_time', minWidth: 80, title: '创建时间', search: 'range'},
                    {
                        width: 250,
                        title: '操作',
                        templet: ea.table.tool,
                        operat: [
                            [{
                                text: '编辑',
                                url: init.edit_url,
                                method: 'open',
                                auth: 'edit',
                                class: 'layui-btn layui-btn-xs layui-btn-success',
                                extend: 'data-full="true"',
                            }],
                            'delete']
                    }
                ]],
            });
            ea.table.listenSwitch({filter: 'status', url: init.modify_url});
            ea.listen();
        },
        add: function () {
            ea.listen();
        },
        edit: function () {
            ea.listen();
        },
        stock: function () {
            ea.listen();
        },
    };
    return Controller;
});