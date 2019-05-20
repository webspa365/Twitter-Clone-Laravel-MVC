<style>
.replies {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.3);
  display: none;
  z-index: 100;
}

.replies .wrapper {
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  width: 565px;
  max-height: 500px;
  margin-top: 75px;
  border-radius: 15px;
  overflow: hidden;
  overflow-y: scroll;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
}

.replies .replyTo .tweet .avatar {
  left: 10px;
}

.replies .header {
  position: relative;
  background: #eee;
  display: inline-block;
  border-bottom: 1px solid #ccc;
  left: 0px;
  width: 100%;
  height: 55px;
}

.replies .header .avatar {
  border: 1px solid #ccc;
  text-align: center;
}

.replies .header .avatar i {
  position: relative;
  font-size: 32px;
  color: #888;
  top: 4px;
  left: 1px;
}

.replies .header .input {
  position: relative;
  display: inline-block;
  width: 100%;
  height: 100%;
  padding: 10px 10px 10px 67px;
}

.replies .header .input input {
  width: 80%;
  height: 34px;
  border-radius: 4px;
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 15px;
  padding-left: 15px;
}

.replies .header .input i {
  position: absolute;
  right: 21px;
  top: 18px;
  font-size: 18px;
  color: #888;
}

.replies .header > .avatar {
  position: absolute;
  left: 26px;
  top: 11px;
  width: 30px;
  height: 30px;
  border-radius: 100%;
  overflow: hidden;
}

.replies .header > .avatar img {
  width: 100%;
  height: 100%;
}

.replies .tweet {
  background: #fff;
}

.replies .tweet .avatar {
  left: 10px;
}

.replies .footer {
  height: 60px;
  text-align: center;
  background: #fff;
  color: #888;
  line-height: 55px;
  border-radius-bottom: 15px;
}

.replies .tweet.notFound {
  padding-top: 15px;
  padding-bottom: 15px;
}
</style>
