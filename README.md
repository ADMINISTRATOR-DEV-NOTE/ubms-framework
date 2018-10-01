ubms_framework 1.0.0
very easy & very tiny & very simple  mvc, rest  framework

GNU General Public License(GPL) 2.0


http://www.ubms.kr



 
 
 -------------------------------nginx setting ----------------------------------------


server{


        
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
 
 
