<style>
.reply {
  padding-left: 70px;
  padding-top: 7.5px;
  padding-bottom: 5px;
  border-bottom: 1px solid #ccc;
  font-size: 14px;
  overflow:;
  text-align: left;
  background: #fff;
}

.reply:hover {
  background: #fdfdfd;
}

.reply > div:not('avatar') {
  position: relative;
  display: block;
  width: 100%;
  border: 0px solid;

}

.reply > .avatar {
  position: absolute;
  width: 48px;
  height: 48px;
  left: 10px;
  border: 1px solid #eee;
  border-radius: 100%;
  overflow: hidden;
  text-align: center;
  background: #eee;
  padding-top: 5px;
  margin-top: 5px;
}

.reply .avatar i {
  position: relative;
  left: 0px;
  top: 3px;
  font-size: 50px;
  color: #888;
}

.reply .avatar img {
  position: absolute;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
}

.reply .info {
  position: relative;
  font-size: 15px;

}

.reply .info .name {
  font-weight: bold;
}

.reply .info .date {
  color: #888;
  font-size: 13px;
  margin-left: 0px;
}

.reply .info .toggle {
  position: relative;
  float: right;
  padding: 15px;
  top: -15px;
  font-size: 18px;
  color: #888;
}

.reply .content {
  padding-right: 16px;
  margin-top: 0px;
  margin-bottom: 10px;
}

.reply .icons {
  display: inline-block;
  padding-top: 10px;
  color: #888;
  border: 0px solid;
}

.reply .icons > div {
  float: left;
  width: 75px;
  font-size: 15px;
}

.reply .icons i {
  margin-right: 10px;
}

.reply .icons i.active {
  color: #f15;
}

.reply .retweeted {
  color: #888;
  font-size: 14px;
  display: block;
  padding-right: 7.5px;
}

.reply .replyingTo {
  color: #0ae;
  margin-bottom: 4px;
}
</style>
