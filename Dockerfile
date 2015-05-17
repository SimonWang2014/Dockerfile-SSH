# ssh

FROM ubuntu:14.04
MAINTAINER wangh <wanghui94@live.com>

# 安装ssh服务
RUN apt-get update && apt-get install -y openssh-server
RUN mkdir /var/run/sshd
RUN 