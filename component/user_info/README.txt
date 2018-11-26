// +----------------------------------------------------------------------
// | Author: Cary <798171920@qq.com>
// +----------------------------------------------------------------------

## 用户信息资料收集插件 插件演示

```
    // 提交用户信息接口

    url post "plugin/user_info/api_index/submitMessage"
     body {
         "name": "cary",
         "company": "foxconn",
         "phone": "13688888888",
         "email": "798171920@qq.com",
         "site": "Gongdong",
         "description": "caryinfo"
     }

    // ------------------------------

     result:
     {
         "code": 1,
         "msg": "信息提交成功",
         "data": {
             "name": "cary",
             "company": "foxconn",
             "phone": "13688888888",
             "email": "798171920@qq.com",
             "site": "Gongdong",
             "description": "caryinfo",
             "create_time": "2018-11-26",
             "update_time": "2018-11-26",
             "id": "15"
         }
     }

```