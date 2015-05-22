# ssh

FROM ubuntu:14.04
MAINTAINER wangh <wanghui94@live.com>

# 安装ssh服务
RUN apt-get update && apt-get install -y openssh-server
RUN mkdir -p /var/run/sshd
# 用户名，密码
RUN echo 'root:12345' | chpasswd
RUN sed -i 's/PermitRootLogin without-password/PermitRootLogin yes/' /etc/ssh/sshd_config

# 取消pam的限制，否则用户登录后就被踢出
RUN sed -ri 's/session required pam_loginuid.so/#session required pam_loginuid.so/g' /etc/pam.d/sshd

EXPOSE 22
CMD ["/usr/sbin/sshd", "-D"]