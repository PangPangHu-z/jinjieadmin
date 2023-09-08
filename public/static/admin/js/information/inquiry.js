define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'information.inquiry/index',
        add_url: 'information.inquiry/add',
        edit_url: 'information.inquiry/edit',
        read_url: 'information.inquiry/read',
        delete_url: 'information.inquiry/delete',
        export_url: 'information.inquiry/export',
        modify_url: 'information.inquiry/modify',
        stock_url: 'information.inquiry/stock',
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
                    {field: 'title', width: 200, title: '询价单名称'},
                    {field: 'project.title', width: 200, title: '项目名称'},
                    {field: 'contacts.name', width: 200, title: '联系人名称'},
                    {field: 'contacts.phone', width: 200, title: '联系人手机号'},
                    {field: 'create_time', minWidth: 80, title: '创建时间', search: 'range'},
                    {
                        width: 250,
                        title: '操作',
                        templet: ea.table.tool,
                        operat: [
                            [{
                                text: '详情',
                                url: init.read_url,
                                method: 'open',
                                auth: 'read',
                                class: 'layui-btn layui-btn-xs layui-btn-success',
                                extend: 'data-full="true"',
                            },{
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