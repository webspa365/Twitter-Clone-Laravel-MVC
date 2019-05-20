<style>
.deleteDialog {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  z-index: 10000;
  display: none;
}

.deleteDialog > div {
  position: relative;
  display: inline-block;
  background: #fff;
  top: 35%;
  transform: translateY(-50%);
  left: 50%;
  transform: translateX(-50%);
  width: 300px;
  height: auto;
  border-radius: 4px;
}

.deleteDialog > div > .header {
  position: relative;
  width: 100%;
  height: 50px;
  border-bottom: 1px solid #ccc;
  text-align: center;
  font-weight: bold;
  font-size: 16px;
  line-height: 50px;
}

.deleteDialog > div > .body {
  position: relative;
  width: 100%;
  min-height: 50px;
  padding: 7.5px 15px;
  border-bottom: 1px solid #ccc;
  text-align: left;
}

.deleteDialog > div > .body h6 {
  margin-bottom: 5px;
  font-size: 14px;
}

.deleteDialog > div > .footer {
  position: relative;
  width: 100%;
  height: 50px;
}

.deleteDialog > div > .footer .button {
  position: relative;
  float: right;
  border-radius: 100px;
  border: 0px solid;
  min-width: 60px;
  height: 34px;
  line-height: 17px;
  margin-top: 7.5px;
  margin-right: 15px;
  padding: 0 15px;
}

.deleteDialog > div > .footer .button.closeButton {
  background: #fff;
  color: #262626;
  border: 1px solid #ccc;
  margin-right: 10px;
}

.deleteDialog .msg {
  position: relative;
  width: 100%;
  color: red;
  white-space: nowrap;
}
</style>
