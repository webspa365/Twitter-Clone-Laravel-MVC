<style>
.replyDialog {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0px;
  background: rgba(0, 0, 0, 0.5);
  z-index: 1000;
}

.replyDialog .wrapper {
  position: relative;
  margin: 0 auto;
  top: 150px;
  width: 610px;
  border-radius: 15px;
  overflow: hidden;
  background: #fff;
}

.replyDialog .modal-header {
  height: 50px;
  padding: 0px;
  border-bottom: 1px solid #ddd;
}

.replyDialog .modal-header > h3 {
  position: relative;
  text-align: center;
  width: 100%;
  height: 50px;
  margin: 0px;
  top: 12px;
  font-size: 20px;
  font-weight: bold;
  border: 0px solid;
}

.replyDialog .modal-header i {
  position: absolute;
  right: 7.5px;
  top: 0px;
  font-size: 18px;
  padding: 15px;
}

.replyDialog .replyTo .tweet {
  border-bottom: 1px solid #ddd;
}

.replyDialog .modal-body {
  background: #fff;
  padding-top: 5px;
}

.replyDialog .modal-body .replying {
  position: relative;
  display: block;
  border: 0px solid;
  padding: 5px;
  padding-left: 22.5px;
  margin-bottom: 5px;
  color: #888;
}

.replyDialog .modal-body .replying span {
  line-height: 10px;
}

.replyDialog .modal-body .avatar {
  position: absolute;
  left: 15px;
  top: 35px;
  width: 32px;
  height: 32px;
  border: 1px solid #ccc;
  border-radius: 100%;
  background: #eee;
  overflow: hidden;
  text-align: center;
  padding-top: 5px;
}

.replyDialog .modal-body .avatar i {
  font-size: 32px;
  color: #888;
}

.replyDialog .modal-body .avatar img {
  position: absolute;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
}

.replyDialog .modal-body .textarea {
  position: relative;
  max-width: 100%;
  height: 80px;
  padding-left: 15px;
  padding-right: 15px;
}

.replyDialog .modal-body .textarea textarea {
  height: 80px;
  resize: none;
  border-radius: 15px;
}

.replyDialog .modal-footer {
  position: relative;
  display: block;
  padding: 0px;
  border-top: 0px solid;
  background: #fff;
  padding-bottom: 7.5px;
}

.replyDialog .modal-footer > div {
  position: relative;
  display: block;
  width: 100%;
  height: 44px;
  top: -15px;
}

.replyDialog .modal-footer .icons {
  position: absolute;
  width: 100%;
  padding-left: 15px;
  margin-top: 20px;
}

.replyDialog .modal-footer .icons li {
  display: inline-block;
  float: left;
  font-size: 21px;
  color: #888;
  padding-left: 15px;
  padding-right: 15px;
}

.replyDialog .modal-footer button {
  position: absolute;
  border-radius: 30px;
  bottom: 2px;
  height: 34px;
  opacity: 0.33;
}

.replyDialog .modal-footer .addButton {
  position: absolute;
  right: 120px;
  top: 24px;
  background: #fff;
  color: #888;
  width: 34px;
  text-align: center;
  padding: 0px;
}

.replyDialog .modal-footer .addButton i {
  position: relative;
  margin: 0 auto;
}

.replyDialog .modal-footer .replyButton {
  position: absolute;
  right: 15px;
  top: 25px;
  font-weight: bold;
  color: #fff;
  background: #0ae !important;
  border: 0px solid;
  border-radius: 15px;
  width: 90px;
  height: 30px;
  line-height: 15px;
}

.replyDialog .modal-footer .addButton.active,
.replyDialog .modal-footer .replyButton.active {
  opacity: 1;
}

.replyDialog .modal-footer .message {
  white-space: nowrap;
  padding-right: 15px;
  height: auto !important;
  left: 0px;
  color: red;
  border: 0px solid;
  text-align: right;
}
</style>
