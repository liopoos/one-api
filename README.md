#  ONE API（V2） #

ONE·一个API可以获取当天的图片，文字，还可以获取过去7天的文章、Q&A、文字图片等。

## 实例效果

[效果页：](http://127.0.0.1/apicenter/d.php?i=1#)[ONE·一个](http://lab.mayuko.cn/one/)

详细介绍：[ONE·一个API更新计划](https://blog.mayuko.cn/archives/2289)

API Center定位：[ONE·一个](https://api.mayuko.cn/d.php?i=1)



## 请求地址

https://api.mayuko.cn/v2/one



## 请求方式

HTTPS	GET



## 请求参数

#### **系统级参数**

所有接入点需要的参数。

| 参数名称 | 类型     | 示例值                              | 必须   | 说明               |
| ---- | ------ | -------------------------------- | ---- | ---------------- |
| SK   | string | c7acff69c5a5acd08fcc4af108b592dd | 必须   | 每一个用户名对应唯一一个SK值。 |

#### **应用级参数**

每个接入点自己的参数。

| 参数名称  | 类型   | 示例值  | 必须   | 说明                                       |
| ----- | ---- | ---- | ---- | ---------------------------------------- |
| date  | int  | 5    | 非必须  | 获取某天的内容，0为当天的内容，1为前一天，2为前两天，最大为6即6天前，默认为0。 |
| value | int  | 1    | 非必须  | 判定输出内容，0为全部输出，1只输出图文，2只输出文章，3只输出问答，默认为1。 |



## 返回参数

以JSON格式返回结果。

#### **系统级参数**

所有接入点需要的参数。

| 参数名称 | 类型     | 说明                 |
| ---- | ------ | ------------------ |
| code | string | 1：正常-1：SK错误-2：参数错误 |

#### **应用级参数**

每个接入点自己的参数。

| 参数名称             | 类型     | 说明     |
| ---------------- | ------ | ------ |
| code             | int    | 返回码    |
| titulo_title     | string | 图文标题   |
| titulo_img_url   | string | 图文图片地址 |
| titulo_img_title | string | 图文图片标题 |
| titulo_content   | string | 图文正文   |
| article_title    | string | 文章标题   |
| article_autor    | string | 文章作者   |
| article_content  | string | 文章正文   |
| question_title   | string | 问答标题   |
| question_q       | string | 问答问题   |
| question_a       | string | 问答答案   |



## 请求实例

以 PHP 为例的请求实例。

```php
$sk = '';
$url = "https://api.mayuko.cn/v2/one?sk=sk&date=2";
echo get_file($url);
function get_file($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}
                    
                
```

以 JAVA 为例的请求实例。

```java
public static void main(String path[]) throws Exception {
    URL u=new URL("https://api.mayuko.cn/v2/one?sk=sk&date=2");
    InputStream in=u.openStream();
    ByteArrayOutputStream out=new ByteArrayOutputStream();
    try {
        byte buf[]=new byte[1024];
        int read = 0;
        while ((read = in.read(buf)) > 0) {
            out.write(buf, 0, read);
        }
    } finally {
        if (in != null) {
            in.close();
        }
    }
    byte b[]=out.toByteArray( );
    System.out.println(new String(b,"utf-8"));
}
                    
                
```

以 Python 为例的请求实例。

```python
import urllib.parse
import urllib.request

data={}
data['sk']=''
data['参数']=''
url_values=urllib.parse.urlencode(data)
url = 'https://api.mayuko.cn/v2/one?sk=sk&date=2?'
full_url=url+url_values
data=urllib.request.urlopen(full_url).read()
z_data=data.decode('UTF-8')
print(z_data)
                    
                
```



## 返回实例

以JSON格式返回结果。

```json
{
“code”:1,
“titulo_title”:“”,
“titulo_img_url”:“”,
“titulo_img_title”:“”,
“article_title”:“”,
“article_autor”:“”,
“article_content”:“”,
“question_title”:“”,
“question_q”:“”,
“question_a”:“”
}
```



## LICENSE

MIT © [Hades](http://github.com/mayuko2012)