ubms_framework 1.0.0

GNU General Public License(GPL) 2.0


http://www.ubms.kr



 
 
 
 
 -------------------------------nginx ----------------------------------------


server
{
        server_name www.domein.xxx;
        root /home/user/mvc_rest_ubms_framework/document_root; 
        index index.php index.html;

        location / {
        try_files $uri $uri/ /index.php?/$request_uri;
        }

        location ~* \.(jpg|jpeg|gif|png|bmp|ico|pdf|flv|swf|exe|html|htm|txt|css|js) {
                add_header        Cache-Control public;
                add_header        Cache-Control must-revalidate;
                expires           7d;
                access_log off;
        }

         location ~ \.php$ {
          include snippets/fastcgi-php.conf;
          fastcgi_pass unix:/run/php/php7.1-fpm.sock; # ubuntu 17.04 --> 7.0  17.10 --> 7.1
          proxy_buffer_size               128k;
          proxy_buffers                   4 256k;
          proxy_busy_buffers_size         256k;
          fastcgi_buffering               on;
          fastcgi_buffer_size             16k;
          fastcgi_buffers                 16 16k;
          fastcgi_connect_timeout         600s;
          fastcgi_send_timeout            600s;
          fastcgi_read_timeout            600s;

        }
}
 
 
 ---------------------------------------------------------------------------------------------
 
 
+
+---------------------------------------------------
+since  2016,10,21 by  혁진 한
+---------------------------------------------------
+
+
+아래는 커밋한 이력 
+---------------------------------------------------
+commit log 
+---------------------------------------------------
+
+ 권중한
+c6ecd84
+test
+2016-11-28
+  권중한
+123771a
+test
+2016-11-28
+  권중한
+46ccad8
+login
+2016-11-28
+  혁진 한
+4f5c46f
+token
+2016-11-28
+  혁진 한
+a42cd11
+token
+2016-11-28
+  혁진 한
+620ffdd
+token
+2016-11-28
+  혁진 한
+22c64cc
+token
+2016-11-28
+  혁진 한
+19d1d20
+token
+2016-11-28
+  혁진 한
+89af128
+token
+2016-11-28
+  혁진 한
+cb839a5
+token
+2016-11-28
+  혁진 한
+d0f3e1a
+route table :num 추가
+2016-11-28
+  혁진 한
+572c0c5
+route table :num 추가
+2016-11-28
+  혁진 한
+9130215
+route table :num 추가
+2016-11-28
+  혁진 한
+045758f
+rest 완성
+2016-11-27
+  혁진 한
+9c8bc3e
+curl
+2016-11-27
+  혁진 한
+43212ab
+rest
+2016-11-26
+  혁진 한
+29bb5c8
+rest
+2016-11-26
+  혁진 한
+5dac662
+rest
+2016-11-26
+  혁진 한
+4f4cc66
+curl
+2016-11-26
+ 혁진 한
+1a06d93
+잡다한 버그
+2016-11-26
+  혁진 한
+3e4c1e7
+잡다한 버그
+2016-11-26
+  혁진 한
+d4f9311
+filter curl test 중
+2016-11-26
+  혁진 한
+44f4e09
+filter curl test 중
+2016-11-26
+  혁진 한
+e2cd4bb
+filter curl test 중
+2016-11-26
+  혁진 한
+bd56f5f
+filter curl test 중
+2016-11-26
+  혁진 한
+658d6a2
+autoload 만드는중
+2016-11-25
+  혁진 한
+f77a9e8
+filter curl test 중
+2016-11-25
+  혁진 한
+4f6cc3b
+fix
+2016-11-25
+  혁진 한
+61cfc62
+라우팅테이블적용
+2016-11-24
+  혁진 한
+9b9dfd0
+라우팅테이블적용
+2016-11-24
+  혁진 한
+42a7621
+라우팅테이블적용
+2016-11-24
+  혁진 한
+821f91e
+라우팅테이블적용
+2016-11-24
+  혁진 한
+eab3299
+라우팅테이블적용
+2016-11-24
+  혁진 한
+2718ada
+라우팅테이블적용
+2016-11-24
+  혁진 한
+ca2b147
+exception
+2016-11-25
+  혁진 한
+06fcc66
+rest 수 정
+2016-11-25
+  혁진 한
+81f0323
+rest 수 정
+2016-11-24
+  혁진 한
+b492b59
+rest 수 정
+2016-11-24
+  혁진 한
+39e3b4a
+config
+2016-11-24
+  혁진 한
+6daa2f3
+config
+2016-11-24
+  혁진 한
+b7cef22
+rest 작동
+2016-11-24
+  혁진 한
+17e6c85
+rest 작동
+2016-11-24
+  혁진 한
+16bc97c
+rest 작동
+2016-11-24
+  혁진 한
+d4c3e8c
+restful 적용및기존코드수정
+2016-11-24
+  혁진 한
+b0c63cb
+model
+2016-11-24
+  혁진 한
+6d1f364
+model
+2016-11-24
+  혁진 한
+ba60377
+outer
+2016-11-22
+  혁진 한
+3d92389
+image
+2016-11-22
+  혁진 한
+db1ba3a
+outer
+2016-11-22
+
+ 혁진 한
+bf5c75e
+outer
+2016-11-22
+  혁진 한
+f104b18
+fix
+2016-11-22
+  혁진 한
+b406122
+fix
+2016-11-22
+  혁진 한
+7b5ea55
+fix
+2016-11-22
+  혁진 한
+7f3ad5d
+fix
+2016-11-22
+  혁진 한
+ceddd23
+fix
+2016-11-22
+  혁진 한
+3a6aaa8
+fix
+2016-11-22
+  혁진 한
+f781777
+fix
+2016-11-22
+  혁진 한
+7564b9b
+fix
+2016-11-22
+  혁진 한
+778a687
+config
+2016-11-20
+  혁진 한
+5b4a839
+config
+2016-11-20
+  혁진 한
+095263c
+config
+2016-11-20
+  혁진 한
+728d74b
+config
+2016-11-20
+  혁진 한
+40a27e0
+config
+2016-11-20
+  혁진 한
+553b502
+config
+2016-11-20
+  혁진 한
+1d8cbaa
+config
+2016-11-20
+  혁진 한
+866d1a1
+config
+2016-11-20
+  혁진 한
+577e1ad
+app_outer
+2016-11-19
+  혁진 한
+de4470e
+ln -sf
+2016-11-19
+  혁진 한
+3731cab
+app location
+2016-11-19
+  혁진 한
+6b5be65
+app location
+2016-11-19
+  혁진 한
+2452c71
+htaccess
+2016-11-19
+  혁진 한
+6786975
+htaccess
+2016-11-19
+  혁진 한
+1578c31
+htaccess
+2016-11-19
+  혁진 한
+37c87d8
+htaccess
+2016-11-19
+  혁진 한
+58026ad
+app
+2016-11-19
+  혁진 한
+904b628
+app
+2016-11-19
+  혁진 한
+3afd41f M
+conflict
+2016-11-19
+  혁진 한
+6ff0540
+no cache
+2016-11-19
+  혁진 한
+6dee101
+no cache
+2016-11-19
+
+Author	Commit	Message	Date	Builds
+  혁진 한
+67a8cb0
+netbeans commit fisrt
+2016-11-05
+  혁진 한
+9b21ce8
+load
+2016-10-24
+  혁진 한
+3724f6f
+path fix
+2016-10-23
+  혁진 한
+295df25
+path fix
+2016-10-23
+  혁진 한
+f72eb65
+fix
+2016-10-23
+  혁진 한
+638df6c
+debug
+2016-10-23
+  혁진 한
+9193ffe
+50%
+2016-10-23
+  혁진 한
+8f4cf13
+exception
+2016-10-22
+  혁진 한
+493d06b
+mvc
+2016-10-21
+  혁진 한
+e13fe18
+core
+2016-10-21
+  혁진 한
+80a310d
+core
+2016-10-21
+  혁진 한
+f1e2ccb M
+Merge branch 'master' of https://bitbucket.org/kimzot18nom/ubms_framework
+2016-10-21
+  혁진 한
+7e7cea0
+core
+2016-10-21
Add a comment to this line
+  혁진 한
+4700b4a
+test
+2016-10-21
