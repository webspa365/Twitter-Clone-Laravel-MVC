<style>
.menu {
  position: fixed;
  display: none;
  margin-left: -150px;
  top: 52px;
  width: 200px;
  border-radius: 4px;
}

.menu > div { /* triangle up border */
  position: absolute;
  right: 28px;
  top: -8px;
	width: 0;
	height: 0;
	border-left: 8px solid transparent;
	border-right: 8px solid transparent;
	border-bottom: 8px solid #ccc;

}

.menu > div > div { /* triangle up */
  position: relative;
  left: -8px;
  top: 1px;
	width: 0;
	height: 0;
	border-left: 8px solid transparent;
	border-right: 8px solid transparent;
	border-bottom: 8px solid #fff;

}

.menu ul {
  background: #fff;
  padding-bottom: 12px;
  border: 1px solid #eee;
  border-radius: 3px;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);
}

.menu ul li {
  padding: 6px 20px;
  color: rgb(72, 72, 72);
}

.menu ul li a {
  color: rgb(72, 72, 72);
}

.menu ul li:first-child {
  font-weight: bold;
  font-size: 15px;
  width: 100%;
  height: 60px;
  margin: 0px;
  border-radius: 4px;
  border: 0px solid;
  text-align: center;
}

.menu ul li:first-child span {
  width: 100%;
  display: block;
  white-space: nowrap;
  overflow: hidden;
}

.menu ul li:first-child span:first-child {
  font-size: 17px;
  padding-top: 3px;
}

.menu ul li:first-child span:last-child {
  font-size: 14px;
  line-height: 14px;
  color: #888;
}

.menu ul li:nth-of-type(2) {
  padding-top: 20px;
  border-top: 1px solid #ccc;
}

.menu ul li div {
  border-radius: 0%;


}

</style>
