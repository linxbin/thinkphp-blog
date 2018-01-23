/**
 * 自定义function公共函数模块
 */
layui.define(['jquery','layer'],function (exports) {
    "use strict";

    var $ = layui.jquery,
        layer = layui.layer;
        var loading;
    var func = {
        /**
         * ajax封装
         * @param url
         * @param data
         * @param fn
         * @param type
         */
        ajax:function (url, data, fn, type) {
            if (type == undefined) {
                type = 'post';
            }
            $.ajax({
                type: type,
                url: url,
                data: data,
                beforeSend:function(){
                    loading = layer.load();
                },
                success: function (msg) {
                    layer.close(loading);
                    if(fn !== undefined){
                        fn(msg);
                    }else{
                        if(msg.respCode !== 10000){
                            layer.msg(msg.respMsg);
                            return false;
                        }
                        layer.msg('操作成功！');
                        setTimeout(function () {
                            location.reload();
                        },"1000")
                    }
                },
                async: true,
                dataType: 'json',
                error: function () {
                    layer.close(loading);
                    layer.msg('服务器繁忙，请稍后再试！');
                },
                timeout: 6000000
            });
            return true;
        },

        getSelectData:function (elememt,sorceData) {
            var datas = [];
            var checkeds = $(elememt).filter(":checked");
            checkeds.each(function (k, dom) {
                var key = $(dom).parent().parent().attr('key');
                var data = sorceData[key];
                datas.push(data);
            });

            return datas;
        },

        getSelectId:function () {
            var ids = [];
            var checkeds = $('[data=checkbox]').filter(":checked");
            checkeds.each(function (k, dom) {
                var id = $(dom).parents('tr').find("input[name=id]").val();
                ids.push(id);
            });

            return ids;
        },

        layerOpen:function(title,content,id) {
            layer.open({
                title: title,
                type: 1,
                content: content,
                id: id,
                area: ['450px']
            });
        }
    };
    exports('func', func);
});