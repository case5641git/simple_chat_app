FROM mysql:8.0.29-debian
 
# 設定ファイルの上書き
COPY ./api/.docker/db/my.cnf /etc/mysql/conf.d
RUN chmod 644 /etc/mysql/conf.d/my.cnf
 
RUN mv /etc/apt/sources.list.d/mysql.list /etc/apt/sources.list.d/mysql.list.disabled
RUN apt-get update && apt-get install -y curl gnupg && apt-get clean
RUN curl -sSfL https://repo.mysql.com/RPM-GPG-KEY-mysql-2023 | gpg --import
RUN gpg --batch --export "B7B3B788A8D3785C" > /etc/apt/keyrings/mysql.gpg
RUN mv /etc/apt/sources.list.d/mysql.list.disabled /etc/apt/sources.list.d/mysql.list
 
RUN apt-get update && apt-get install -y locales \
    && echo "ja_JP.UTF-8 UTF-8" > /etc/locale.gen \
    && locale-gen ja_JP.UTF-8 \
    && update-locale LANG=ja_JP.UTF-8
 
ENV LANG ja_JP.UTF-8
 
CMD ["mysqld"]