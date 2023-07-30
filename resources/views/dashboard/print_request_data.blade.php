<style type="text/css">
  /*rating*/
.rate-area {
  float: left;
  border-style: none;
}

.rate-area:not(:checked) > input {
  position: absolute;
  top: -9999px;
  clip: rect(0, 0, 0, 0);
}
.cb_b{
  background: white;
    box-shadow: -1px 1px 20px 5px #e5dede;
    border-radius: 10px;
}
.rate-area:not(:checked) > label {
  float: right;
  width: 0.8em;
  height: 55px;
  overflow: hidden;
  white-space: nowrap;
  cursor: pointer;
  font-size: 50px;
  color: lightgrey;padding-top: 10px;
}

.rate-area:not(:checked) > label:before {
  content: "★";
}

.rate-area > input:checked ~ label {
  color: gold;
}

.rate-area:not(:checked) > label:hover,
.rate-area:not(:checked) > label:hover ~ label {
  color: gold;
}

.rate-area > input:checked + label:hover,
.rate-area > input:checked + label:hover ~ label,
.rate-area > input:checked ~ label:hover,
.rate-area > input:checked ~ label:hover ~ label,
.rate-area > label:hover ~ input:checked ~ label {
  color: gold;
}

@charset "UTF-8";

.site-navbar {
  background-color: #00aaca
}
.top_color a{
  color: #80d5e5 !important;
}
a.nav-link.b-2{
    border-right: 2px solid #80d5e5 !important;

}
.card-text.p-8 {
    padding: 9px;
}
.noti_card {
    width: 100%;
    height: 100%;
    background: white;
    border-radius: 10px;
    padding: 15px;
    box-shadow: -1px 1px 20px 5px #e5dede;
}
.noti_footer{
  text-align: right;
  color: grey;
  font-size: 10px;
}
.fa-solid, .fas {
    font-weight: 900;
    margin-right: 4px;
}
.navbar-default .navbar-toolbar .nav-link:focus, .navbar-default .navbar-toolbar .nav-link:hover {
   
    background-color: transparent;
    color: white !important;
}
/*.navbar-toolbar .nav-link{
  padding-top: 10px !important;
}*/
.site-navbar .navbar-header {
  background-color: transparent;
  color: #fff;
  height: inherit;
  width: 260px;
  -webkit-transition: width .25s;
  -o-transition: width .25s;
  transition: width .25s
}

.site-navbar .navbar-header .navbar-toggler {
  color: #fff
}

.site-navbar .navbar-header .hamburger .hamburger-bar,
.site-navbar .navbar-header .hamburger:after,
.site-navbar .navbar-header .hamburger:before {
  background-color: #fff
}

.site-navbar .navbar-header .navbar-brand {
  float: none;
  margin-right: 0;
  color: #fff;
  font-family: Roboto, sans-serif;
  cursor: pointer;
  text-align: center;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap
}

.site-navbar .navbar-header .navbar-brand-logo {
  height: 22px;
  -webkit-transition: height .25s;
  -o-transition: height .25s;
  transition: height .25s
}

.site-navbar .navbar-header .navbar-brand-text {
  display: none
}

@media (min-width:768px) {
  .site-navbar .navbar-header {
    width: 65px
  }
}

.site-navbar .navbar-container {
  background-color: #fff
}

@media (min-width:768px) {
  .site-navbar .navbar-container {
    margin-left: 0;
    -webkit-transition: margin-left .25s;
    -o-transition: margin-left .25s;
    transition: margin-left .25s;
    background-color:  #00aaca;
  }
}

.site-navbar.navbar-inverse .navbar-container {
  background-color: transparent
}

@media (max-width:767px) {
  .site-navbar.navbar .navbar-header {
    -webkit-box-flex: 1;
    -webkit-flex: 1 1 auto;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto
  }
a.nav-link.b-2{
    border-right: 0px solid #80d5e5 !important;

}
  .site-navbar.navbar .navbar-collapse {
    -webkit-box-flex: 1;
    -webkit-flex: 1 1 100%;
    -ms-flex: 1 1 100%;
    flex: 1 1 100%
  }

  .site-navbar.navbar .navbar-search {
    -webkit-box-flex: 1;
    -webkit-flex: 1 1 100%;
    -ms-flex: 1 1 100%;
    flex: 1 1 100%
  }
}

body,
html {
  height: 100%
}

body {
  padding-top: 66.01px
}

.site-menubar {
  z-index: 1400;
  position: fixed;
  top: 66.01px;
  height: 100%;
  height: -webkit-calc(100% - 66.01px);
  height: calc(100% - 66.01px);
  width: 260px;
  background: #00aaca;
  color: #ffffff;
  font-family: Roboto, sans-serif;
  -webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, .08);
  box-shadow: 0 2px 4px rgba(0, 0, 0, .08);
  -webkit-transition: width .25s, opacity .25s, -webkit-transform .25s;
  -o-transition: width .25s, opacity .25s, -o-transform .25s;
  transition: width .25s, opacity .25s, transform .25s
}

.site-menubar ul {
  list-style: none;
  margin: 0;
  padding: 0
}

.site-menubar a {
  outline: 0
}

.site-menubar a:focus,
.site-menubar a:hover {
  text-decoration: none
}

.site-menubar.site-menubar-light {
  background: #fff;
  -webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, .08);
  box-shadow: 0 2px 4px rgba(0, 0, 0, .08)
}

.site-menubar.site-menubar-light .scrollable-inverse.scrollable .scrollable-bar-handle {
  background: rgba(163, 175, 183, .6)
}

.site-menubar:not(.mm-menu) .site-menu-sub {
  display: none
}

.site-menubar:not(.mm-menu)>.site-menu>.site-menu-item:hover>.site-menu-sub {
  display: block
}


.site-menubar-light .site-menubar-footer {
  background-color: #e4eaec
}

.site-menubar-light .site-menubar-footer>a {
  background-color: #e4eaec
}

.site-menubar-light .site-menubar-footer>a:focus,
.site-menubar-light .site-menubar-footer>a:hover {
  background-color: #d5dee1
}

.site-menu {
  font-size: 14px;
  overflow: visible;
  padding-bottom: 20px;
  -webkit-transition: -webkit-transform .25s;
  -o-transition: -o-transform .25s;
  transition: transform .25s
}

.site-menu-item {
  -webkit-transition: -webkit-transform .1s, all .25s, border 0;
  -o-transition: -o-transform .1s, all .25s, border 0;
  transition: transform .1s, all .25s, border 0;
  line-height: 36px
}

.site-menu-item>a {
  white-space: nowrap;
  cursor: pointer
}

.site-menu-icon {
  display: inline-block;
  margin-right: 5px;
  width: 1em;
  text-align: center
}
.top_bar{
  margin-left: 110px;
}
.site-menu-title {
  display: inline-block;
  max-width: 160px;
  vertical-align: middle;
  -webkit-transition: visibility .25s, opacity .25s;
  -o-transition: visibility .25s, opacity .25s;
  transition: visibility .25s, opacity .25s;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap
}

.site-menu-title:first-child {
  margin-left: 25px
}

.site-menu-arrow {
  font-family: "Web Icons";
  position: relative;
  display: inline-block;
  font-style: normal;
  font-weight: 400;
  -webkit-transform: translate(0, 0);
  -ms-transform: translate(0, 0);
  -o-transform: translate(0, 0);
  transform: translate(0, 0);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  speak: none;
  text-rendering: auto
}

.site-menu-arrow:before {
  content: ""
}

.site-menu-arrow,
.site-menu-badge,
.site-menu-label {
  position: absolute;
  right: 25px;
  display: inline-block;
  vertical-align: middle;
  -webkit-transition: visibility cubic-bezier(.76, .1, 1, -.16) .25s, opacity cubic-bezier(.76, .1, 1, -.16) .5s;
  -o-transition: visibility cubic-bezier(.76, .1, 1, -.16) .25s, opacity cubic-bezier(.76, .1, 1, -.16) .5s;
  transition: visibility cubic-bezier(.76, .1, 1, -.16) .25s, opacity cubic-bezier(.76, .1, 1, -.16) .5s
}

.site-menu .badge,
.site-menu .label {
  padding: 2px 5px 3px;
  font-size: .858rem;
  font-weight: 300
}

.site-menu-item {
  position: relative;
  white-space: nowrap
}

.site-menu-item a {
  display: block;
  color: #80d5e5;
}

.site-menu-item:hover>a {
  color: rgba(255, 255, 255, .8);
  background-color: rgba(255, 255, 255, .02)
}

.site-menu-item.active {
  background: #242f35
}

.site-menu-item.active>a {
  color: #fff;
  background: 0 0
}

.site-menu-item.active.hover>a {
  background: 0 0
}

.site-menu>.site-menu-item {
  font-size: 14px;
  padding: 0
}

.site-menu>.site-menu-item>a {
  padding: 0 25px;
  line-height: 46px
}

.site-menu>.site-menu-item.active {
  border-top: 1px solid rgba(0, 0, 0, .04);
  border-bottom: 1px solid rgba(0, 0, 0, .04)
}

.site-menu-item>.site-menu-sub {
  background-color: #242f35
}

.site-menubar-light .site-menu-item a {
  color: rgba(118, 131, 143, .9)
}

.site-menubar-light .site-menu-item:hover {
  background-color: rgba(11, 105, 227, .05)
}

.site-menubar-light .site-menu-item:hover>a {
  color: #3e8ef7;
  background: 0 0
}

.site-menubar-light .site-menu-item.active {
  background: rgba(11, 105, 227, .05)
}

.site-menubar-light .site-menu-item.active>a {
  color: #3e8ef7
}

.site-menubar-light .site-menu-item>.site-menu-sub {
  background-color: rgba(11, 105, 227, .05)
}

.site-gridmenu {
  position: fixed;
  top: 66.01px;
  bottom: 0;
  padding: 0;
  background-color: #263238;
  z-index: 1500;
  opacity: 0;
  visibility: hidden
}

.js>.site-gridmenu {
  -webkit-transition: opacity .5s ease 0s, visibility 0s;
  -o-transition: opacity .5s ease 0s, visibility 0s;
  transition: opacity .5s ease 0s, visibility 0s
}

.site-gridmenu-active>.site-gridmenu {
  opacity: 1;
  visibility: visible;
  -webkit-transition: opacity .5s ease 0s;
  -o-transition: opacity .5s ease 0s;
  transition: opacity .5s ease 0s
}

.site-gridmenu-active>.site-gridmenu ul {
  opacity: 1;
  -webkit-transform: rotateX(0);
  transform: rotateX(0)
}

.site-gridmenu ul {
  margin: 0;
  padding: 0;
  list-style: none;
  opacity: .4;
  -webkit-transform: translateY(-25%) rotateX(35deg);
  transform: translateY(-25%) rotateX(35deg);
  -webkit-transition: -webkit-transform .5s ease 0s, opacity .5s ease 0s;
  -o-transition: -o-transform .5s ease 0s, opacity .5s ease 0s;
  transition: transform .5s ease 0s, opacity .5s ease 0s
}

.site-gridmenu li {
  float: left;
  width: 50%;
  text-align: center
}

.site-gridmenu li>a {
  display: block;
  padding: 30px 15px;
  color: #a3afb7
}

.site-gridmenu li .icon {
  display: block;
  margin-bottom: 10px;
  font-size: 24px
}

.site-gridmenu li:hover>a {
  color: #fff;
  cursor: pointer;
  text-decoration: none;
  background-color: rgba(255, 255, 255, .02)
}

body.site-gridmenu-active {
  overflow: hidden
}

.site-gridmenu-toggle:after {
  opacity: 0;
  font-family: "Web Icons";
  font-size: 1rem;
  -webkit-transition: opacity .15s;
  -o-transition: opacity .15s;
  transition: opacity .15s;
  position: relative;
  display: inline-block;
  font-style: normal;
  font-weight: 400;
  -webkit-transform: translate(0, 0);
  -ms-transform: translate(0, 0);
  -o-transform: translate(0, 0);
  transform: translate(0, 0);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  speak: none;
  text-rendering: auto;
  position: relative;
  right: -3px;
  top: -1px;
  content: ""
}

.site-gridmenu-active .site-gridmenu-toggle:after {
  opacity: 1
}

.site-sidebar {
  z-index: 1210
}

.site-sidebar.slidePanel {
  -webkit-box-shadow: 0 0 8px 0 rgba(0, 0, 0, .2);
  box-shadow: 0 0 8px 0 rgba(0, 0, 0, .2)
}

.site-sidebar.slidePanel.slidePanel-left,
.site-sidebar.slidePanel.slidePanel-right {
  width: 300px;
  overflow: hidden
}

.site-sidebar-content {
  height: 100%
}

.site-sidebar-nav.nav-tabs>.nav-item {
  -webkit-box-flex: 1;
  -webkit-flex: 1 1 33.3333%;
  -ms-flex: 1 1 33.3333%;
  flex: 1 1 33.3333%
}

.site-sidebar-nav.nav-tabs>.nav-item>.nav-link {
  padding: 0;
  font-size: 16px;
  line-height: 90px;
  text-align: center
}

.site-sidebar-nav.nav-tabs>.nav-item>.nav-link>.icon {
  margin-right: 0
}

.site-sidebar-tab-content {
  height: 100%;
  height: -webkit-calc(100% - 90px);
  height: calc(100% - 90px)
}

.site-sidebar-tab-content>.tab-pane {
  height: 100%;
  padding: 20px 30px
}

.site-sidebar-tab-content>.tab-pane.scrollable {
  padding: 0
}

.site-sidebar-tab-content>.tab-pane .scrollable-content {
  padding: 20px 30px
}

.site-sidebar-tab-content>.tab-pane .list-group {
  margin-right: -30px;
  margin-left: -30px
}

.site-sidebar-tab-content>.tab-pane .list-group>.list-group-item {
  padding-right: 30px;
  padding-left: 30px
}

.site-sidebar .conversation {
  position: absolute;
  top: 0;
  right: -100%;
  z-index: 1700;
  width: 100%;
  height: 100%;
  background-color: #fff;
  -webkit-transition: all .3s;
  -o-transition: all .3s;
  transition: all .3s
}

.site-sidebar .conversation.active {
  right: 0
}

.site-sidebar .conversation-header {
  height: 90px;
  border-bottom: 1px solid #e4eaec
}

.site-sidebar .conversation-header>* {
  padding: 0 30px;
  margin: 0;
  line-height: 90px
}

.site-sidebar .conversation-more,
.site-sidebar .conversation-return {
  color: rgba(55, 71, 79, .4);
  cursor: pointer
}

.site-sidebar .conversation-more:focus,
.site-sidebar .conversation-more:hover,
.site-sidebar .conversation-return:focus,
.site-sidebar .conversation-return:hover {
  color: rgba(55, 71, 79, .6)
}

.site-sidebar .conversation-more:active,
.site-sidebar .conversation-return:active {
  color: #37474f
}

.site-sidebar .conversation-title {
  position: relative;
  top: 1px;
  z-index: -1;
  color: #37474f;
  text-align: center
}

.site-sidebar .conversation-content {
  padding: 30px 15px
}

.site-sidebar .conversation-reply {
  position: absolute;
  right: 0;
  bottom: 0;
  left: 0;
  height: 60px;
  padding: 10px 0;
  background-color: #fff;
  border-top: 1px solid #e4eaec
}

.site-sidebar .conversation-reply .form-control {
  border: 0;
  border-right: 1px solid #e4eaec
}

.site-sidebar .conversation .chats {
  height: -webkit-calc(100% - 150px);
  height: calc(100% - 150px);
  overflow-y: auto
}

@media (max-width:767px) {

  .site-sidebar.slidePanel.slidePanel-left,
  .site-sidebar.slidePanel.slidePanel-right {
    width: 100%
  }
}

.site-action {
  position: fixed;
  right: 32px;
  bottom: 55px;
  z-index: 1290;
  -webkit-animation-duration: 3s;
  -o-animation-duration: 3s;
  animation-duration: 3s
}

.site-action input {
  display: none
}

.site-action .btn {
  -webkit-box-shadow: 0 10px 10px 0 rgba(60, 60, 60, .1);
  box-shadow: 0 10px 10px 0 rgba(60, 60, 60, .1)
}

.site-action .front-icon {
  display: block
}

.site-action .back-icon {
  display: none
}

.site-action-buttons {
  position: absolute;
  bottom: 56px;
  left: 0;
  display: none;
  width: 100%;
  text-align: center
}

.site-action-buttons .btn {
  display: block;
  margin: 0 auto;
  margin-bottom: 10px;
  -webkit-animation-delay: .1s;
  -o-animation-delay: .1s;
  animation-delay: .1s
}

.site-action.active .front-icon {
  display: none
}

.site-action.active .back-icon {
  display: block
}

.site-action.active .site-action-buttons {
  display: block
}

@media (max-width:767px) {
  .site-action .btn-floating {
    width: 46px;
    height: 46px;
    padding: 0;
    font-size: 16px;
    -webkit-box-shadow: 0 6px 6px 0 rgba(60, 60, 60, .1);
    box-shadow: 0 6px 6px 0 rgba(60, 60, 60, .1)
  }

  .site-action-buttons {
    bottom: 46px
  }
}
.modal-dialog{
  width: 350px;
}
.card{
  box-shadow: -1px 1px 20px 5px #e5dede;
  border-radius: 10px;
  color: #000000;
  margin-right: 50px;
  margin-left: 20px;
  margin-bottom: 0px !important;
}
.c_p_11{
  padding: 11px !important;
  border-radius: 10px !important;
}

.ml-13{
  margin-left: 13px;
}
/* pretty radio */
input[type="checkbox"] {
  display: none;
}
input[type="checkbox"] + *::before {
  content: "";
  display: inline-block;
  vertical-align: -3px;
  width: 0.8rem;
  height: 0.8rem;
  margin-right: 0.3rem;
  border-radius: 50%;
  border-style: solid;
  border-width: 0.1rem;
  border-color: #dbd6d6;
}
input[type="checkbox"]:checked + * {
  color: water;
}
input[type="checkbox"]:checked + *::before {
  background: radial-gradient(#00aaca 0%, #00aaca 40%, transparent 50%, transparent);
  border-color: #dbd6d6;
}

/* basic layout */










.res_card{
 /*width: 30rem;*/
  border-radius: 10px;
  color: #000000;
  margin-right: 30px;
  margin-left: 30px;
  margin-bottom: 0px !important;
  font-weight: 500;
}
.card .card-title{
border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    background: #d6f3f8;
    padding: 15px;
    color: #000000;
    margin: 0px !important;
    font-weight: 500;
}
.card-footer{
      text-align: center;
    border-bottom-left-radius: 10px !important;
    border-bottom-right-radius: 10px !important;
    background: #49b265;
    padding: 10px;
    color: #ffffff;
    text-align: center;
    margin-top: 5px;
}
.card-body{
  padding: 0px !important;
}
.card-text{
  padding-left: 15px;
}
.page {
  position: relative;
  min-height: -webkit-calc(100% - 44px);
  min-height: calc(100% - 44px);
  background: #ffffff
}

.page-dark.layout-full {
  position: relative;
  z-index: 0;
  color: #fff
}

.page-dark.layout-full::before {
  position: fixed;
  top: 0;
  left: 0;
  z-index: -1;
  width: 100%;
  height: 100%;
  content: "";
  background-position: center top;
  -webkit-background-size: cover;
  background-size: cover
}

.page-dark.layout-full::after {
  position: fixed;
  top: 0;
  left: 0;
  z-index: -1;
  width: 100%;
  height: 100%;
  content: "";
  background-color: rgba(38, 50, 56, .6)
}

.page-dark.layout-full .brand {
  margin-bottom: 22px
}

.page-dark.layout-full .brand-text {
  font-size: 18px;
  color: #fff;
  text-transform: uppercase
}

.page-nav-tabs {
  padding: 0 30px
}

.page-content {
  padding: 30px 30px
}

@media (max-width:479px) {
  .page-content {
    padding: 10px
  }
}

.page-content-actions {
  padding: 0 30px 30px
}

.page-content-actions::after {
  display: block;
  clear: both;
  content: ""
}

.page-content-actions .dropdown {
  display: inline-block
}

.page-content-table {
  max-width: 100%;
  padding: 0;
  overflow-x: auto
}

.page-content-table .table>tbody>tr>td,
.page-content-table .table>tbody>tr>th,
.page-content-table .table>thead>tr>td,
.page-content-table .table>thead>tr>th {
  padding-top: 20px;
  padding-bottom: 20px
}

.page-content-table .table>tbody>tr>td:first-child,
.page-content-table .table>tbody>tr>th:first-child,
.page-content-table .table>thead>tr>td:first-child,
.page-content-table .table>thead>tr>th:first-child {
  padding-left: 30px
}

.page-content-table .table>tbody>tr>td:last-child,
.page-content-table .table>tbody>tr>th:last-child,
.page-content-table .table>thead>tr>td:last-child,
.page-content-table .table>thead>tr>th:last-child {
  padding-right: 30px
}

.page-content-table .table>tbody>tr:hover>td {
  background-color: #f3f7f9
}

.page-content-table .table>tbody>tr>td {
  cursor: pointer
}

.page-content-table .table>tbody>tr:last-child td {
  border-bottom: 1px solid #e4eaec
}

.page-content-table .table.is-indent>tbody>tr>td.pre-cell,
.page-content-table .table.is-indent>tbody>tr>td.suf-cell,
.page-content-table .table.is-indent>tbody>tr>th.pre-cell,
.page-content-table .table.is-indent>tbody>tr>th.suf-cell,
.page-content-table .table.is-indent>thead>tr>td.pre-cell,
.page-content-table .table.is-indent>thead>tr>td.suf-cell,
.page-content-table .table.is-indent>thead>tr>th.pre-cell,
.page-content-table .table.is-indent>thead>tr>th.suf-cell {
  width: 30px;
  padding: 0;
  border-top: 0;
  border-bottom: 0
}

.page-content-table .table.is-indent>tbody>tr:first-child td {
  border-top: 0
}

.page-content-table .table.is-indent>tbody>tr:last-child td.pre-cell,
.page-content-table .table.is-indent>tbody>tr:last-child td.suf-cell {
  border-bottom: 0
}

.page-content-table .table.is-indent>tfoot>tr>td {
  border-top: 0
}

.page-content-table .pagination {
  margin-right: 30px;
  margin-left: 30px
}

.page-copyright {
  margin-top: 60px;
  font-size: .858rem;
  color: #37474f;
  letter-spacing: 1px
}

.page-copyright .social .icon {
  color: rgba(55, 71, 79, .6);
  font-size: 1.143rem
}

.page-copyright .social .icon:focus,
.page-copyright .social .icon:hover {
  color: rgba(55, 71, 79, .8)
}

.page-copyright .social .icon.active,
.page-copyright .social .icon:active {
  color: #37474f
}

.page-copyright-inverse {
  color: #fff
}

.page-copyright-inverse .social .icon {
  color: #fff
}

.page-copyright-inverse .social .icon:active,
.page-copyright-inverse .social .icon:hover {
  color: rgba(255, 255, 255, .8)
}

@media (max-width:991px) {
  .page {
    min-height: -webkit-calc(100% - 66px);
    min-height: calc(100% - 66px)
  }
}

.page-header+.page-content {
  padding-top: 0
}

.page-title {
  margin-top: 0;
  margin-bottom: 0;
  font-size: 26px
}

.page-title>.icon {
  margin-right: .3em
}

.page-description {
  color: #a3afb7
}

.page-header {
  position: relative;
  padding: 30px 30px;
  margin-top: 0;
  margin-bottom: 0;
  background: 0 0;
  border-bottom: 0
}

@media (max-width:479px) {
  .page-header {
    padding: 10px
  }
}

.page-header-actions {
  position: absolute;
  top: 50%;
  right: 30px;
  margin: auto;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%)
}

.page-header-actions .btn-icon {
  margin-left: 6px
}

.page-header-actions>* {
  margin-bottom: 0
}

.page-header .breadcrumb {
  padding: 0;
  margin: 0
}

.page-header-bordered {
  padding-top: 20px;
  padding-bottom: 20px;
  margin-bottom: 30px;
  background-color: #fff;
  border-bottom: 1px solid transparent
}

.page-header-tabs {
  padding-bottom: 0
}

.page-header-tabs .nav-tabs-line {
  margin-top: 5px;
  border-bottom-color: transparent
}

.page-header-tabs .nav-tabs-line>li>a {
  padding: 5px 20px
}

.page-aside {
  position: absolute;
  top: 0;
  bottom: 0;
  width: 260px;
  border-right: 1px solid #e4eaec;
  background: #fff;
  -webkit-transition: visibility .1s ease, top .3s ease, left .5s ease, right .5s ease;
  -o-transition: visibility .1s ease, top .3s ease, left .5s ease, right .5s ease;
  transition: visibility .1s ease, top .3s ease, left .5s ease, right .5s ease;
  overflow-y: hidden
}

.page-aside .list-group-item.active,
.page-aside .list-group-item.active:focus,
.page-aside .list-group-item.active:hover {
  z-index: 0
}

.page-aside-left .page-aside {
  left: 0
}

.page-aside-left .page-aside+.page-main {
  margin-left: 260px
}

.page-aside-right .page-aside {
  right: 0
}

.page-aside-right .page-aside+.page-main {
  margin-right: 260px
}

.page-aside-right .page-aside .page-aside-inner {
  border-left: 1px solid #e4eaec;
  border-right: none
}

.page-aside-fixed .page-aside {
  position: fixed;
  top: 66.01px;
  height: -webkit-calc(100% - 66.01px);
  height: calc(100% - 66.01px)
}

.page-aside-fixed .page-aside-inner {
  overflow-y: scroll;
  height: 100%
}

.page-aside-fixed.page-aside-left .site-footer {
  margin-left: 260px
}

.page-aside-fixed.page-aside-right .site-footer {
  margin-right: 260px
}

.page-aside-section {
  position: relative
}

.page-aside-section:first-child {
  padding-top: 22px
}

.page-aside-section:last-child {
  margin-bottom: 22px
}

.page-aside-section:after {
  content: "";
  position: relative;
  display: block;
  margin: 22px;
  border-bottom: 1px solid #e4eaec
}

.page-aside-section:last-child:after {
  display: none
}

.page-aside-switch {
  display: none;
  cursor: pointer;
  position: absolute;
  top: -webkit-calc(50% - 25px);
  top: calc(50% - 25px);
  background-color: #fff;
  -webkit-box-shadow: 1px 0 3px rgba(0, 0, 0, .2);
  box-shadow: 1px 0 3px rgba(0, 0, 0, .2);
  border-radius: 0 100px 100px 0;
  line-height: 1;
  padding: 15px 8px 15px 4px
}

.page-aside-switch .wb-chevron-right {
  display: inline-block
}

.page-aside-switch .wb-chevron-left {
  display: none
}

.page-aside-left .page-aside-switch {
  left: -webkit-calc(100% - 1px);
  left: calc(100% - 1px);
  padding: 15px 8px 15px 4px;
  border-radius: 0 100px 100px 0
}

.page-aside-left .page-aside-switch .wb-chevron-right {
  display: inline-block
}

.page-aside-left .page-aside-switch .wb-chevron-left {
  display: none
}

.page-aside-right .page-aside-switch {
  left: auto;
  right: -webkit-calc(100% - 1px);
  right: calc(100% - 1px);
  padding: 15px 4px 15px 8px;
  border-radius: 100px 0 0 100px
}

.page-aside-right .page-aside-switch .wb-chevron-right {
  display: none
}

.page-aside-right .page-aside-switch .wb-chevron-left {
  display: inline-block
}

.page-aside-title {
  padding: 10px 30px;
  margin: 20px 0 10px;
  font-weight: 500;
  color: #526069;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  cursor: default
}

.page-aside .list-group {
  margin-bottom: 22px
}

.page-aside .list-group-item {
  padding: 13px 30px;
  margin-bottom: 1px;
  border: none;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis
}

.page-aside .list-group-item .icon {
  color: #a3afb7
}

.page-aside .list-group-item .item-right {
  float: right
}

.page-aside .list-group-item:focus,
.page-aside .list-group-item:hover {
  background-color: #f3f7f9;
  border: none;
  color: #3e8ef7
}

.page-aside .list-group-item:focus>.icon,
.page-aside .list-group-item:hover>.icon {
  color: #3e8ef7
}

.page-aside .list-group-item.active {
  background-color: transparent;
  color: #3e8ef7
}

.page-aside .list-group-item.active>.icon {
  color: #3e8ef7
}

.page-aside .list-group-item.active:focus,
.page-aside .list-group-item.active:hover {
  background-color: #f3f7f9;
  border: none;
  color: #3e8ef7
}

.page-aside .list-group-item.active:focus>.icon,
.page-aside .list-group-item.active:hover>.icon {
  color: #3e8ef7
}

.page-aside .list-group.has-actions .list-group-item {
  cursor: pointer;
  padding-top: 6px;
  padding-bottom: 6px;
  line-height: 2.573rem
}

.page-aside .list-group.has-actions .list-group-item .list-editable {
  display: none;
  position: relative
}

.page-aside .list-group.has-actions .list-group-item .list-editable .input-editable-close {
  position: absolute;
  top: 50%;
  right: 0;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  z-index: 1;
  margin: 0;
  padding: 0;
  cursor: pointer;
  background: 0 0;
  border: 0;
  outline: 0;
  -webkit-appearance: none
}

.page-aside .list-group.has-actions .list-group-item .list-editable .form-group {
  margin: 0
}

.page-aside .list-group.has-actions .list-group-item .item-actions {
  display: none;
  position: absolute;
  right: 20px;
  top: 6px
}

.page-aside .list-group.has-actions .list-group-item .item-actions .btn-icon {
  padding-left: 2px;
  padding-right: 2px;
  background-color: transparent
}

.page-aside .list-group.has-actions .list-group-item .item-actions .btn-icon:hover .icon {
  color: #3e8ef7
}

.page-aside .list-group.has-actions .list-group-item .item-actions .icon {
  margin: 0
}

.page-aside .list-group.has-actions .list-group-item:hover .item-right {
  display: none
}

.page-aside .list-group.has-actions .list-group-item:hover .item-actions {
  display: block
}

.page-aside .list-group.has-actions .list-group-item:hover .item-actions .icon {
  color: #76838f
}

@media (max-width:1199px) {
  .page-aside {
    width: 220px
  }

  .page-aside-left .page-aside+.page-main {
    margin-left: 220px
  }

  .page-aside-right .page-aside+.page-main {
    margin-right: 220px
  }

  .page-aside-fixed.page-aside-left .site-footer {
    margin-left: 220px
  }

  .page-aside-fixed.page-aside-right .site-footer {
    margin-right: 220px
  }
}

@media (max-width:767px) {
  .page-aside {
    position: fixed;
    top: 66.01px;
    width: 260px;
    border-color: transparent;
    z-index: 1100;
    overflow-y: visible;
    height: -webkit-calc(100% - 66.01px);
    height: calc(100% - 66.01px);
    visibility: visible
  }

  .site-navbar-collapse-show .page-aside {
    top: 132.02px;
    height: -webkit-calc(100% - 132.02px);
    height: calc(100% - 132.02px)
  }

  .site-menubar-changing .page-aside,
  .site-menubar-open .page-aside {
    height: 100%
  }

  .page-aside .page-aside-inner {
    height: 100%;
    background-color: #fff;
    border-right: 1px solid #e4eaec
  }

  .page-aside.open {
    left: 0
  }

  .site-menubar-changing .page-aside.open,
  .site-menubar-open .page-aside.open {
    visibility: hidden
  }

  .page-aside.open .page-aside-switch .wb-chevron-right {
    display: none
  }

  .page-aside.open .page-aside-switch .wb-chevron-left {
    display: inline
  }

  .page-aside-left .page-aside {
    left: -260px
  }

  .page-aside-left .page-aside+.page-main {
    margin-left: 0
  }

  .page-aside-right .page-aside {
    right: -260px
  }

  .page-aside-right .page-aside+.page-main {
    margin-right: 0
  }

  .page-aside-right .page-aside.open .page-aside-switch .wb-chevron-right {
    display: inline
  }

  .page-aside-right .page-aside.open .page-aside-switch .wb-chevron-left {
    display: none
  }

  .page-aside-left .page-aside {
    left: -260px !important
  }

  .page-aside-left .page-aside.open {
    left: 0 !important
  }

  .page-aside-left .site-footer {
    margin-left: 0 !important
  }

  .page-aside-right .page-aside {
    right: -260px !important
  }

  .page-aside-right .page-aside.open {
    left: auto;
    right: 0 !important
  }

  .page-aside-right .site-footer {
    margin-right: 0 !important
  }

  .page-aside-switch {
    display: block
  }
}

.site-footer {
  height: 44px;
  padding: 10px 30px;
  background-color: rgba(0, 0, 0, .02);
  border-top: 1px solid #e4eaec
}

.site-footer::after {
  display: block;
  clear: both;
  content: ""
}

@media (max-width:479px) {
  .site-footer {
    height: auto
  }
}

.site-footer-legal {
  float: left
}

.site-footer-actions {
  float: right
}

.site-footer-right {
  float: right
}

.site-footer .scroll-to-top {
  color: #76838f
}

.site-footer .scroll-to-top,
.site-footer .scroll-to-top:active,
.site-footer .scroll-to-top:hover {
  text-decoration: none
}

@media (max-width:479px) {

  .site-footer-actions,
  .site-footer-legal,
  .site-footer-right {
    display: block;
    float: none;
    text-align: center
  }
}

.layout-full {
  height: 100%;
  padding-top: 0 !important
}

.layout-full .page {
  height: 100%;
  margin: 0 !important;
  padding: 0;
  background-color: transparent
}

.layout-full>.loader {
  margin-left: 0 !important
}

@media (min-width:1200px) {
  .layout-boxed {
    background: #e4eaec
  }

  .layout-boxed,
  .layout-boxed .site-navbar {
    max-width: 1320px;
    margin-left: auto;
    margin-right: auto
  }
}

.layout-boxed .slidePanel-left,
.layout-boxed .slidePanel-right {
  top: 0;
  z-index: 1510
}

.site-print {
  padding-top: 0
}

.site-print .site-footer,
.site-print .site-gridmenu,
.site-print .site-menubar,
.site-print .site-navbar {
  display: none
}

.site-print .page {
  margin: 0 !important
}

.site-menubar-fold .page,
.site-menubar-fold .site-footer {
  margin-left: 200px;
  -webkit-transition: width .25s;
  -o-transition: width .25s;
  transition: width .25s
}

.site-menubar-fold.page-aside-fixed.page-aside-left .page-aside {
  left: 65px
}

.site-menubar-fold.page-aside-fixed.page-aside-left .site-footer {
  margin-left: 325px
}

.site-menubar-fold.page-aside-fixed.page-aside-right .site-footer {
  margin-right: 260px
}

.site-menubar-fold .site-menu>.site-menu-item {
  font-size: 14px
}

.site-menubar-fold .site-menu>.site-menu-item>a {
  height: 46px
}

.site-menubar-fold .site-menu>.site-menu-item>a .site-menu-arrow,
.site-menubar-fold .site-menu>.site-menu-item>a .site-menu-badge,
.site-menubar-fold .site-menu>.site-menu-item>a .site-menu-title {
  opacity: 0;
  visibility: hidden
}

.site-menubar-fold .site-menubar {
  width: 65px
}

@media (min-width:768px) {
  .site-menubar-fold.site-menubar-hover .site-navbar .navbar-header {
    width: 260px;
    -webkit-transition: width .25s;
    -o-transition: width .25s;
    transition: width .25s
  }
}

@media (min-width:768px) {
  .site-menubar-fold.site-menubar-hover .site-navbar .navbar-container {
    margin-left: 0
  }
}

.site-menubar-fold.site-menubar-hover .site-navbar .navbar-brand {
  float: left;
  text-align: left
}

.site-menubar-fold.site-menubar-hover .site-navbar .navbar-brand-logo {
  height: 26px
}

.site-menubar-fold.site-menubar-hover .site-navbar .navbar-brand-text {
  display: inline-block
}

.site-menubar-fold.site-menubar-hover .site-menubar {
  width: 260px
}

.site-menubar-fold.site-menubar-hover .site-menu>.site-menu-item>a .site-menu-arrow,
.site-menubar-fold.site-menubar-hover .site-menu>.site-menu-item>a .site-menu-badge,
.site-menubar-fold.site-menubar-hover .site-menu>.site-menu-item>a .site-menu-title {
  opacity: 1;
  visibility: visible
}

.site-menubar-fold.site-menubar-hover .site-menubar-footer {
  width: 260px
}

.site-menubar-fold:not(.site-menubar-hover) .mm-panels>.mm-panel {
  -ms-transform: translate(100%, 0);
  -webkit-transform: translate3d(100%, 0, 0);
  transform: translate3d(100%, 0, 0)
}

.site-menubar-fold:not(.site-menubar-hover) .mm-panels>.mm-panel.mm-current:first-child,
.site-menubar-fold:not(.site-menubar-hover) .mm-panels>.mm-panel.mm-subopened:first-child {
  display: block !important;
  -ms-transform: translate(0, 0);
  -webkit-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0)
}

.site-menubar-fold .site-gridmenu {
  width: 65px
}

.site-menubar-fold .site-gridmenu li {
  float: none;
  width: 100%
}

.site-menubar-fold .site-gridmenu li>a {
  padding: 15px 0
}

.site-menubar-fold .site-gridmenu-toggle:after {
  display: none
}

.site-menubar-fold:not(.site-menubar-hover) .site-menubar-footer {
  overflow: hidden;
  width: 65px
}

.site-menubar-fold:not(.site-menubar-hover) .site-menubar-footer>a {
  width: 65px
}

.site-menubar-fold.site-menubar-changing .site-menu>.site-menu-item>.site-menu-sub {
  display: none
}

@media (min-width:768px) {

  .css-menubar .page,
  .css-menubar .site-footer {
    margin-left: 65px;
    -webkit-transition: width .25s;
    -o-transition: width .25s;
    transition: width .25s
  }

  .css-menubar.page-aside-fixed.page-aside-left .page-aside {
    left: 65px
  }

  .css-menubar.page-aside-fixed.page-aside-left .site-footer {
    margin-left: 325px
  }

  .css-menubar.page-aside-fixed.page-aside-right .site-footer {
    margin-right: 260px
  }

  .css-menubar.page-aside-fixed.page-aside-left .site-footer {
    margin-left: 325px
  }

  .css-menubar.page-aside-fixed.page-aside-right .site-footer {
    margin-right: 260px
  }

  .css-menubar .site-menu>.site-menu-item {
    font-size: 14px
  }

  .css-menubar .site-menu>.site-menu-item>a {
    height: 46px
  }

  .css-menubar .site-menu>.site-menu-item>a .site-menu-arrow,
  .css-menubar .site-menu>.site-menu-item>a .site-menu-badge,
  .css-menubar .site-menu>.site-menu-item>a .site-menu-title {
    opacity: 0;
    visibility: hidden
  }

  .css-menubar .site-menubar {
    width: 65px
  }

  .css-menubar .site-gridmenu {
    width: 65px
  }

  .css-menubar .site-gridmenu li {
    float: none;
    width: 100%
  }

  .css-menubar .site-gridmenu li>a {
    padding: 15px 0
  }

  .css-menubar .site-gridmenu-toggle:after {
    display: none
  }

  .css-menubar:not(.site-menubar-hover) .site-menubar-footer {
    overflow: hidden;
    width: 65px
  }

  .css-menubar:not(.site-menubar-hover) .site-menubar-footer>a {
    width: 65px
  }

  .css-menubar .site-menu .site-menu-item:hover>.site-menu-sub {
    position: absolute;
    left: 100%;
    top: 0;
    display: block;
    width: 240px
  }

  .css-menubar .site-menu .site-menu-sub {
    display: none
  }

  .site-menubar-fold.page-aside-fixed.page-aside-left .site-footer {
    margin-left: 325px
  }

  .site-menubar-fold.page-aside-fixed.page-aside-right .site-footer {
    margin-right: 260px
  }
}

.site-menubar-unfold .page,
.site-menubar-unfold .site-footer {
  margin-left: 260px;
  -webkit-transition: margin-left .25s;
  -o-transition: margin-left .25s;
  transition: margin-left .25s
}

.site-menubar-unfold.page-aside-fixed .page-aside {
  left: 260px
}

.site-menubar-unfold.page-aside-fixed .site-footer {
  margin-left: 520px
}

@media (min-width:768px) {
  .site-menubar-unfold .site-navbar .navbar-header {
    width: 260px;
    -webkit-transition: width .25s;
    -o-transition: width .25s;
    transition: width .25s
  }
}

@media (min-width:768px) {
  .site-menubar-unfold .site-navbar .navbar-container {
    margin-left: 0
  }
}

.site-menubar-unfold .site-navbar .navbar-brand {
  float: left;
  text-align: left
}

.site-menubar-unfold .site-navbar .navbar-brand-logo {
  height: 26px
}

.site-menubar-unfold .site-navbar .navbar-brand-text {
  display: inline-block
}

.site-menubar-unfold.site-menubar-native .site-menubar-body {
  overflow-y: scroll
}

.site-menubar-unfold .site-menubar {
  width: 260px
}

.site-menubar-unfold .site-gridmenu {
  width: 260px
}

.site-menubar-unfold .site-menubar-footer {
  width: 260px
}

.site-menubar-unfold [data-toggle=menubar] .hamburger-arrow-left {
  -webkit-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg)
}

.site-menubar-unfold [data-toggle=menubar] .hamburger-arrow-left:before {
  width: .6em;
  -webkit-transform: translate3d(.45em, .1em, 0) rotate(45deg);
  transform: translate3d(.45em, .1em, 0) rotate(45deg)
}

.site-menubar-unfold [data-toggle=menubar] .hamburger-arrow-left .hamburger-bar {
  border-radius: .2em
}

.site-menubar-unfold [data-toggle=menubar] .hamburger-arrow-left:after {
  width: .6em;
  -webkit-transform: translate3d(.45em, -.1em, 0) rotate(-45deg);
  transform: translate3d(.45em, -.1em, 0) rotate(-45deg)
}

@media (min-width:768px) and (max-width:1199px) {
  .site-menubar-unfold.page-aside-fixed .site-footer {
    margin-left: 480px
  }
}

@media (max-width:767px) {

  .site-menubar-unfold .page,
  .site-menubar-unfold .site-footer {
    margin-left: auto
  }
.card{
  margin-right: 0px !important;
  margin-bottom: 10px !important;
}
  .site-menubar-unfold.page-aside-fixed .page-aside {
    left: auto
  }
.top_bar{
  margin: 0px !important;
}

  .site-menubar-open .page,
  .site-menubar-open .site-footer {
    -ms-transform: translate(260px, 0);
    -webkit-transform: translate3d(260px, 0, 0);
    transform: translate3d(260px, 0, 0)
  }

  .site-menubar-changing {
    overflow: hidden
  }

  .site-menubar-changing .page,
  .site-menubar-changing .site-footer {
    -webkit-transition: -webkit-transform .25s;
    -o-transition: -o-transform .25s;
    transition: transform .25s
  }

  .site-gridmenu {
    width: 100% !important;
    background: rgba(38, 50, 56, .9)
  }

  .site-menubar-hide .site-menubar,
  .site-menubar-open .site-menubar {
    -webkit-transition: -webkit-transform .25s, top .35s, height .35s;
    -o-transition: -o-transform .25s, top .35s, height .35s;
    transition: transform .25s, top .35s, height .35s
  }

  .site-menubar-open .site-menubar {
    -ms-transform: translate(0, 0);
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0)
  }
}

@media (max-width:767px) {
  .site-navbar-collapsing {
    -webkit-transition: padding-top .35s;
    -o-transition: padding-top .35s;
    transition: padding-top .35s
  }

  body.site-navbar-collapse-show {
    padding-top: 132.02px
  }

  .site-navbar-collapse-show .slidePanel.slidePanel-left,
  .site-navbar-collapse-show .slidePanel.slidePanel-right {
    top: 132.02px;
    -webkit-transition: top .35s;
    -o-transition: top .35s;
    transition: top .35s
  }
}

body.site-navbar-small {
  padding-top: 4.286rem
}

.site-navbar-small .site-navbar {
  height: 4.286rem;
  min-height: 4.286rem
}

.site-navbar-small .site-navbar .navbar-brand {
  height: 4.286rem;
  padding: 1.357rem 1.529rem;
  background-color:  #000000;
}

.site-navbar-small .site-navbar .navbar-nav {
  margin: .6785rem -1.0715rem
}

@media (min-width:768px) {
  .site-navbar-small .site-navbar .navbar-nav>li>a {
    padding-top: 1.357rem;
    padding-bottom: 1.357rem
  }
}

.site-navbar-small .site-navbar .navbar-toggler {
  height: 4.286rem;
  padding: 1.357rem 1.0715rem
}

.site-navbar-small .site-navbar .navbar-toolbar>li>a {
  padding-top: 1.357rem;
  padding-bottom: 1.357rem;
  font-size: 13px;
}

.site-navbar-small .site-navbar .navbar-nav>li>a.navbar-avatar,
.site-navbar-small .site-navbar .navbar-toolbar>li>a.navbar-avatar {
  padding-top: 1.0715rem;
  padding-bottom: 1.0715rem
}

.site-navbar-small .site-navbar .navbar-search-overlap .form-control {
  height: 4.286rem !important
}

.site-navbar-small .page-aside-fixed .page-aside {
  top: 4.286rem;
  height: -webkit-calc(100% - 4.286rem);
  height: calc(100% - 4.286rem)
}

.site-navbar-small .site-menubar {
  top: 4.286rem;
  height: 100%;
}

.site-navbar-small .site-skintools {
  top: 6.429rem
}

.site-navbar-small .slidePanel-left,
.site-navbar-small .slidePanel-right {
  top: 4.286rem
}

@media (max-width:767px) {
  body.site-navbar-small {
    padding-top: 4.286rem
  }

  body.site-navbar-small .site-navbar {
    height: auto
  }

  body.site-navbar-small .site-menubar {
    top: 4.286rem;
    height: -webkit-calc(100% - 4.286rem);
    height: calc(100% - 4.286rem)
  }

  body.site-navbar-small .page-aside {
    top: 4.286rem;
    height: -webkit-calc(100% - 4.286rem);
    height: calc(100% - 4.286rem)
  }

  body.site-navbar-small .page-aside-fixed .page-aside {
    top: 4.286rem;
    height: -webkit-calc(100% - 4.286rem);
    height: calc(100% - 4.286rem)
  }

  body.site-navbar-small .site-skintools {
    top: 6.429rem
  }

  body.site-navbar-small .slidePanel-left,
  body.site-navbar-small .slidePanel-right {
    top: 4.286rem
  }

  body.site-navbar-small.site-navbar-collapse-show {
    padding-top: 8.572rem
  }

  body.site-navbar-small.site-navbar-collapse-show .site-menubar {
    top: 8.572rem;
    height: -webkit-calc(100% - 8.572rem);
    height: calc(100% - 8.572rem)
  }

  body.site-navbar-small.site-navbar-collapse-show .page-aside {
    top: 8.572rem;
    height: -webkit-calc(100% - 8.572rem);
    height: calc(100% - 8.572rem)
  }

  body.site-navbar-small.site-navbar-collapse-show .site-skintools {
    top: 10.715rem
  }

  body.site-navbar-small.site-navbar-collapse-show .slidePanel.slidePanel-left,
  body.site-navbar-small.site-navbar-collapse-show .slidePanel.slidePanel-right {
    top: 8.572rem
  }
}

@media (max-width:767px) {
  .site-navbar .brand {
    display: none
  }

  .site-navbar .brand-mobile {
    display: block
  }

  .site-menubar {
    top: 66.01px;
    height: -webkit-calc(100% - 66.01px);
    height: calc(100% - 66.01px);
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-perspective: 1000;
    perspective: 1000;
    -ms-transform: translate(-260px, 0);
    -webkit-transform: translate3d(-260px, 0, 0);
    transform: translate3d(-260px, 0, 0)
  }

  .site-navbar-collapse-show .site-menubar {
    top: 132.02px;
    height: -webkit-calc(100% - 132.02px);
    height: calc(100% - 132.02px)
  }

  .site-menubar-footer {
    visibility: hidden
  }

  .site-menubar-open .site-menubar-footer {
    visibility: visible
  }

  .disable-scrolling {
    overflow: hidden;
    height: 100%
  }

  body.site-menubar-open {
    overflow: hidden;
    height: 100%
  }

  body.site-menubar-open .page {
    overflow: hidden;
    height: 100%;
    pointer-events: none
  }
}

.checkbox-custom,
.radio-custom {
  position: relative;
  display: block;
  margin-top: 10px;
  margin-bottom: 10px
}

.checkbox-custom label,
.radio-custom label {
  min-height: 22px;
  margin-bottom: 0;
  font-weight: 300;
  cursor: pointer
}

.checkbox-custom input[type=checkbox],
.radio-custom input[type=radio] {
  position: absolute;
  margin-top: 0;
  margin-bottom: 0;
  margin-left: -20px
}

.checkbox-custom.disabled label,
.radio-custom.disabled label,
fieldset[disabled] .checkbox-custom label,
fieldset[disabled] .radio-custom label {
  cursor: not-allowed
}

.input-group-addon .checkbox-custom,
.input-group-addon .radio-custom {
  margin: 0
}

.checkbox-custom {
  padding-left: 20px
}

.checkbox-custom label {
  position: relative;
  display: inline-block;
  padding-left: 10px;
  vertical-align: middle
}

.checkbox-custom label:empty {
  padding-left: 0
}

.checkbox-custom label::before {
  position: absolute;
  left: 0;
  display: inline-block;
  width: 20px;
  height: 20px;
  margin-left: -20px;
  content: "";
  background-color: #fff;
  border: 1px solid #e4eaec;
  border-radius: .215rem;
  -webkit-transition: all .3s ease-in-out 0s;
  -o-transition: all .3s ease-in-out 0s;
  transition: all .3s ease-in-out 0s
}

.checkbox-custom label::after {
  position: absolute;
  top: 0;
  left: 0;
  display: inline-block;
  width: 20px;
  height: 20px;
  padding-top: 1px;
  margin-left: -20px;
  font-size: 12px;
  line-height: 20px;
  color: #76838f;
  text-align: center
}

.checkbox-custom input[type=checkbox],
.checkbox-custom input[type=radio] {
  z-index: 1;
  width: 20px;
  height: 20px;
  cursor: pointer;
  opacity: 0
}

.checkbox-custom input[type=checkbox]:checked+input[type=hidden]+label::before,
.checkbox-custom input[type=checkbox]:checked+label::before,
.checkbox-custom input[type=radio]:checked+input[type=hidden]+label::before,
.checkbox-custom input[type=radio]:checked+label::before {
  border-color: #e4eaec;
  border-width: 10px;
  -webkit-transition: all .3s ease-in-out 0s;
  -o-transition: all .3s ease-in-out 0s;
  transition: all .3s ease-in-out 0s
}

.checkbox-custom input[type=checkbox]:checked+input[type=hidden]+label::after,
.checkbox-custom input[type=checkbox]:checked+label::after,
.checkbox-custom input[type=radio]:checked+input[type=hidden]+label::after,
.checkbox-custom input[type=radio]:checked+label::after {
  font-family: "Web Icons";
  content: ""
}

.checkbox-custom input[type=checkbox]:disabled,
.checkbox-custom input[type=radio]:disabled {
  cursor: not-allowed
}

.checkbox-custom input[type=checkbox]:disabled+input[type=hidden]+label,
.checkbox-custom input[type=checkbox]:disabled+label,
.checkbox-custom input[type=radio]:disabled+input[type=hidden]+label,
.checkbox-custom input[type=radio]:disabled+label {
  opacity: .65
}

.checkbox-custom input[type=checkbox]:disabled+input[type=hidden]+label::before,
.checkbox-custom input[type=checkbox]:disabled+label::before,
.checkbox-custom input[type=radio]:disabled+input[type=hidden]+label::before,
.checkbox-custom input[type=radio]:disabled+label::before {
  cursor: not-allowed;
  background-color: #f3f7f9;
  border-color: #e4eaec;
  border-width: 1px
}

.checkbox-custom.checkbox-circle label::before {
  border-radius: 50%
}

.checkbox-custom.checkbox-inline {
  display: inline-block;
  margin-top: 0;
  margin-bottom: 0
}

.checkbox-inline+.checkbox-inline {
  margin-left: 20px
}

.checkbox-default input[type=checkbox]:checked+input[type=hidden]+label::before,
.checkbox-default input[type=checkbox]:checked+label::before,
.checkbox-default input[type=radio]:checked+input[type=hidden]+label::before,
.checkbox-default input[type=radio]:checked+label::before {
  background-color: #fff;
  border-color: #e4eaec;
  border-width: 1px
}

.checkbox-default input[type=checkbox]:checked+input[type=hidden]+label::after,
.checkbox-default input[type=checkbox]:checked+label::after,
.checkbox-default input[type=radio]:checked+input[type=hidden]+label::after,
.checkbox-default input[type=radio]:checked+label::after {
  color: #3e8ef7
}

.checkbox-primary input[type=checkbox]:checked+input[type=hidden]+label::before,
.checkbox-primary input[type=checkbox]:checked+label::before,
.checkbox-primary input[type=radio]:checked+input[type=hidden]+label::before,
.checkbox-primary input[type=radio]:checked+label::before {
  background-color: #3e8ef7;
  border-color: #3e8ef7
}

.checkbox-primary input[type=checkbox]:checked+input[type=hidden]+label::after,
.checkbox-primary input[type=checkbox]:checked+label::after,
.checkbox-primary input[type=radio]:checked+input[type=hidden]+label::after,
.checkbox-primary input[type=radio]:checked+label::after {
  color: #fff
}

.checkbox-danger input[type=checkbox]:checked+input[type=hidden]+label::before,
.checkbox-danger input[type=checkbox]:checked+label::before,
.checkbox-danger input[type=radio]:checked+input[type=hidden]+label::before,
.checkbox-danger input[type=radio]:checked+label::before {
  background-color: #ff4c52;
  border-color: #ff4c52
}

.checkbox-danger input[type=checkbox]:checked+input[type=hidden]+label::after,
.checkbox-danger input[type=checkbox]:checked+label::after,
.checkbox-danger input[type=radio]:checked+input[type=hidden]+label::after,
.checkbox-danger input[type=radio]:checked+label::after {
  color: #fff
}

.checkbox-info input[type=checkbox]:checked+input[type=hidden]+label::before,
.checkbox-info input[type=checkbox]:checked+label::before,
.checkbox-info input[type=radio]:checked+input[type=hidden]+label::before,
.checkbox-info input[type=radio]:checked+label::before {
  background-color: #0bb2d4;
  border-color: #0bb2d4
}

.checkbox-info input[type=checkbox]:checked+input[type=hidden]+label::after,
.checkbox-info input[type=checkbox]:checked+label::after,
.checkbox-info input[type=radio]:checked+input[type=hidden]+label::after,
.checkbox-info input[type=radio]:checked+label::after {
  color: #fff
}

.checkbox-warning input[type=checkbox]:checked+input[type=hidden]+label::before,
.checkbox-warning input[type=checkbox]:checked+label::before,
.checkbox-warning input[type=radio]:checked+input[type=hidden]+label::before,
.checkbox-warning input[type=radio]:checked+label::before {
  background-color: #eb6709;
  border-color: #eb6709
}

.checkbox-warning input[type=checkbox]:checked+input[type=hidden]+label::after,
.checkbox-warning input[type=checkbox]:checked+label::after,
.checkbox-warning input[type=radio]:checked+input[type=hidden]+label::after,
.checkbox-warning input[type=radio]:checked+label::after {
  color: #fff
}

.checkbox-success input[type=checkbox]:checked+input[type=hidden]+label::before,
.checkbox-success input[type=checkbox]:checked+label::before,
.checkbox-success input[type=radio]:checked+input[type=hidden]+label::before,
.checkbox-success input[type=radio]:checked+label::before {
  background-color: #11c26d;
  border-color: #11c26d
}

.checkbox-success input[type=checkbox]:checked+input[type=hidden]+label::after,
.checkbox-success input[type=checkbox]:checked+label::after,
.checkbox-success input[type=radio]:checked+input[type=hidden]+label::after,
.checkbox-success input[type=radio]:checked+label::after {
  color: #fff
}

.checkbox-sm {
  padding-left: 18px
}

.checkbox-sm label {
  padding-left: 8px
}

.checkbox-sm label:empty {
  padding-left: 0
}

.checkbox-sm label::after,
.checkbox-sm label::before {
  width: 18px;
  height: 18px;
  margin-left: -18px
}

.checkbox-sm label::after {
  font-size: 10px;
  line-height: 18px
}

.checkbox-sm input[type=checkbox],
.checkbox-sm input[type=radio] {
  width: 18px;
  height: 18px
}

.checkbox-sm input[type=checkbox]:checked+input[type=hidden]+label::before,
.checkbox-sm input[type=checkbox]:checked+label::before,
.checkbox-sm input[type=radio]:checked+input[type=hidden]+label::before,
.checkbox-sm input[type=radio]:checked+label::before {
  border-width: 9px
}

.checkbox-lg {
  padding-left: 24px
}

.checkbox-lg label {
  padding-left: 12px
}

.checkbox-lg label:empty {
  padding-left: 0
}

.checkbox-lg label::after,
.checkbox-lg label::before {
  width: 24px;
  height: 24px;
  margin-left: -24px
}

.checkbox-lg label::after {
  font-size: 14px;
  line-height: 24px
}

.checkbox-lg input[type=checkbox],
.checkbox-lg input[type=radio] {
  width: 24px;
  height: 24px
}

.checkbox-lg input[type=checkbox]:checked+input[type=hidden]+label::before,
.checkbox-lg input[type=checkbox]:checked+label::before,
.checkbox-lg input[type=radio]:checked+input[type=hidden]+label::before,
.checkbox-lg input[type=radio]:checked+label::before {
  border-width: 12px
}

.radio-custom {
  padding-left: 20px
}

.radio-custom label {
  position: relative;
  display: inline-block;
  padding-left: 10px;
  vertical-align: middle
}

.radio-custom label:empty {
  padding-left: 0
}

.radio-custom label::before {
  position: absolute;
  left: 0;
  display: inline-block;
  width: 20px;
  height: 20px;
  margin-left: -20px;
  content: "";
  background-color: #fff;
  border: 1px solid #e4eaec;
  border-radius: 50%;
  -webkit-transition: border .3s ease-in-out 0s, color .3s ease-in-out 0s;
  -o-transition: border .3s ease-in-out 0s, color .3s ease-in-out 0s;
  transition: border .3s ease-in-out 0s, color .3s ease-in-out 0s
}

.radio-custom label::after {
  position: absolute;
  top: 7px;
  left: 7px;
  display: inline-block;
  width: 6px;
  height: 6px;
  margin-left: -20px;
  content: " ";
  background-color: transparent;
  border: 2px solid #76838f;
  border-radius: 50%;
  -webkit-transition: .1s cubic-bezier(.8, -.33, .2, 1.33);
  -o-transition: .1s cubic-bezier(.8, -.33, .2, 1.33);
  transition: .1s cubic-bezier(.8, -.33, .2, 1.33);
  -webkit-transform: scale(0, 0);
  -ms-transform: scale(0, 0);
  -o-transform: scale(0, 0);
  transform: scale(0, 0)
}

.radio-custom input[type=radio] {
  z-index: 1;
  width: 20px;
  height: 20px;
  cursor: pointer;
  opacity: 0
}

.radio-custom input[type=radio]:checked+input[type=hidden]+label::before,
.radio-custom input[type=radio]:checked+label::before {
  border-color: #e4eaec;
  border-width: 10px
}

.radio-custom input[type=radio]:checked+input[type=hidden]+label::after,
.radio-custom input[type=radio]:checked+label::after {
  -webkit-transform: scale(1, 1);
  -ms-transform: scale(1, 1);
  -o-transform: scale(1, 1);
  transform: scale(1, 1)
}

.radio-custom input[type=radio]:disabled {
  cursor: not-allowed
}

.radio-custom input[type=radio]:disabled+input[type=hidden]+label,
.radio-custom input[type=radio]:disabled+label {
  opacity: .65
}

.radio-custom input[type=radio]:disabled+input[type=hidden]+label::before,
.radio-custom input[type=radio]:disabled+label::before {
  cursor: not-allowed
}

.radio-custom.radio-inline {
  display: inline-block;
  margin-top: 0;
  margin-bottom: 0
}

.radio-inline+.radio-inline {
  margin-left: 20px
}

.radio-default input[type=radio]:checked+input[type=hidden]+label::before,
.radio-default input[type=radio]:checked+label::before {
  background-color: #fff;
  border-color: #e4eaec;
  border-width: 1px
}

.radio-default input[type=radio]:checked+input[type=hidden]+label::after,
.radio-default input[type=radio]:checked+label::after {
  border-color: #3e8ef7
}

.radio-primary input[type=radio]:checked+input[type=hidden]+label::before,
.radio-primary input[type=radio]:checked+label::before {
  border-color: #3e8ef7
}

.radio-primary input[type=radio]:checked+input[type=hidden]+label::after,
.radio-primary input[type=radio]:checked+label::after {
  border-color: #fff
}

.radio-danger input[type=radio]:checked+input[type=hidden]+label::before,
.radio-danger input[type=radio]:checked+label::before {
  border-color: #ff4c52
}

.radio-danger input[type=radio]:checked+input[type=hidden]+label::after,
.radio-danger input[type=radio]:checked+label::after {
  border-color: #fff
}

.radio-info input[type=radio]:checked+input[type=hidden]+label::before,
.radio-info input[type=radio]:checked+label::before {
  border-color: #0bb2d4
}

.radio-info input[type=radio]:checked+input[type=hidden]+label::after,
.radio-info input[type=radio]:checked+label::after {
  border-color: #fff
}

.radio-warning input[type=radio]:checked+input[type=hidden]+label::before,
.radio-warning input[type=radio]:checked+label::before {
  border-color: #eb6709
}

.radio-warning input[type=radio]:checked+input[type=hidden]+label::after,
.radio-warning input[type=radio]:checked+label::after {
  border-color: #fff
}

.radio-success input[type=radio]:checked+input[type=hidden]+label::before,
.radio-success input[type=radio]:checked+label::before {
  border-color: #11c26d
}

.radio-success input[type=radio]:checked+input[type=hidden]+label::after,
.radio-success input[type=radio]:checked+label::after {
  border-color: #fff
}

.radio-sm {
  padding-left: 18px
}

.radio-sm label {
  padding-left: 8px
}

.radio-sm label:empty {
  padding-left: 0
}

.radio-sm label::before {
  width: 18px;
  height: 18px;
  margin-left: -20px
}

.radio-sm label::after {
  top: 7px;
  left: 7px;
  width: 4px;
  height: 4px;
  margin-left: -20px;
  border-width: 2px
}

.radio-sm input[type=radio] {
  width: 18px;
  height: 18px
}

.radio-sm input[type=radio]:checked+input[type=hidden]+label::before,
.radio-sm input[type=radio]:checked+label::before {
  border-width: 9px
}

.radio-lg {
  padding-left: 24px
}

.radio-lg label {
  padding-left: 12px
}

.radio-lg label:empty {
  padding-left: 0
}

.radio-lg label::before {
  width: 24px;
  height: 24px;
  margin-left: -20px
}

.radio-lg label::after {
  top: 8px;
  left: 8px;
  width: 8px;
  height: 8px;
  margin-left: -20px;
  border-width: 2px
}

.radio-lg input[type=radio] {
  width: 24px;
  height: 24px
}

.radio-lg input[type=radio]:checked+input[type=hidden]+label::before,
.radio-lg input[type=radio]:checked+label::before {
  border-width: 12px
}

@media (min-width:768px) {

  .form-inline .checkbox-custom,
  .form-inline .radio-custom {
    display: inline-block;
    margin-top: 0;
    margin-bottom: 0;
    vertical-align: middle
  }

  .form-inline .checkbox-custom label,
  .form-inline .radio-custom label {
    padding-left: 0
  }

  .form-inline .checkbox-custom input[type=checkbox],
  .form-inline .radio-custom input[type=radio] {
    position: relative;
    margin-left: 0
  }

  .form-inline .radio-custom label {
    padding-left: 10px
  }

  .form-inline .checkbox-custom label {
    padding-left: 10px
  }

  .form-inline .checkbox-custom input[type=checkbox] {
    position: absolute;
    margin-left: -20px
  }

  .form-inline .radio-custom input[type=radio] {
    position: absolute;
    margin-left: -20px
  }
}

.form-horizontal .checkbox-custom,
.form-horizontal .radio-custom {
  padding-top: .501rem;
  margin-top: 0;
  margin-bottom: 0
}

.form-horizontal .checkbox-custom,
.form-horizontal .radio-custom {
  min-height: 2.073rem
}

.form-material {
  position: relative
}

.form-material.floating {
  margin-top: 20px;
  margin-bottom: 20px
}

.form-material.floating+.form-material.floating {
  margin-top: 40px
}

.form-material .form-control {
  padding-right: 0;
  padding-left: 0;
  background-color: transparent;
  background-color: transparent;
  background-repeat: no-repeat;
  background-position: center bottom, center -webkit-calc(100% - 1px);
  background-position: center bottom, center calc(100% - 1px);
  -webkit-background-size: 0 2px, 100% 1px;
  background-size: 0 2px, 100% 1px;
  -webkit-transition: background 0s ease-out;
  -o-transition: background 0s ease-out;
  transition: background 0s ease-out
}

.form-material .form-control,
.form-material .form-control.focus,
.form-material .form-control:focus {
  background-image: -webkit-gradient(linear, left top, left bottom, from(#3e8ef7), to(#3e8ef7)), -webkit-gradient(linear, left top, left bottom, from(#e4eaec), to(#e4eaec));
  background-image: -webkit-linear-gradient(#3e8ef7, #3e8ef7), -webkit-linear-gradient(#e4eaec, #e4eaec);
  background-image: -o-linear-gradient(#3e8ef7, #3e8ef7), -o-linear-gradient(#e4eaec, #e4eaec);
  background-image: linear-gradient(#3e8ef7, #3e8ef7), linear-gradient(#e4eaec, #e4eaec);
  float: none;
  border: 0;
  border-radius: 0;
  -webkit-box-shadow: none;
  box-shadow: none
}

.no-cssgradients .form-material .form-control {
  border-bottom: 2px solid #e4eaec
}

.form-material .form-control::-webkit-input-placeholder {
  color: #a3afb7
}

.form-material .form-control::-moz-placeholder {
  color: #a3afb7
}

.form-material .form-control:-ms-input-placeholder {
  color: #a3afb7
}

.form-material .form-control:disabled::-webkit-input-placeholder {
  color: #ccd5db
}

.form-material .form-control:disabled::-moz-placeholder {
  color: #ccd5db
}

.form-material .form-control:disabled:-ms-input-placeholder {
  color: #ccd5db
}

.form-material .form-control.focus,
.form-material .form-control:focus {
  -webkit-background-size: 100% 2px, 100% 1px;
  background-size: 100% 2px, 100% 1px;
  outline: 0;
  -webkit-transition-duration: .3s;
  -o-transition-duration: .3s;
  transition-duration: .3s
}

.no-cssgradients .form-material .form-control.focus,
.no-cssgradients .form-material .form-control:focus {
  background: 0 0;
  border-bottom: 2px solid #3e8ef7
}

.form-material .form-control:disabled,
.form-material .form-control[disabled],
fieldset[disabled] .form-material .form-control {
  background: 0 0;
  background: 0 0;
  border-bottom: 1px dashed #ccd5db
}

.form-material .form-control:disabled~.floating-label,
.form-material .form-control[disabled]~.floating-label,
fieldset[disabled] .form-material .form-control~.floating-label {
  color: #ccd5db
}

.form-material select[multiple],
.form-material select[size],
.form-material textarea.form-control {
  height: auto
}

.form-material .form-control-label {
  font-weight: 500
}

.form-material.form-group .form-control-label {
  padding-top: 0;
  padding-bottom: 0
}

.form-material .floating-label {
  position: absolute;
  left: 0;
  font-size: 1rem;
  color: #76838f;
  pointer-events: none;
  -webkit-transition: .3s ease all;
  -o-transition: .3s ease all;
  transition: .3s ease all
}

.form-material .floating-label.floating-label-static {
  position: relative;
  top: auto;
  display: block
}

.form-material [class*=col-]>.floating-label {
  left: 1.0715rem
}

.form-material .form-control~.floating-label {
  top: .571429rem;
  font-size: 1rem
}

.form-material .form-control.focus~.floating-label,
.form-material .form-control:focus~.floating-label,
.form-material .form-control:not(.empty)~.floating-label {
  top: -.8rem;
  font-size: .8rem
}

.form-material .form-control:-webkit-autofill~.floating-label {
  top: -.8rem;
  font-size: .8rem
}

.form-material .form-control-sm~.floating-label {
  top: .429rem;
  font-size: .858rem
}

.form-material .form-control-sm.focus~.floating-label,
.form-material .form-control-sm:focus~.floating-label,
.form-material .form-control-sm:not(.empty)~.floating-label {
  top: -.6864rem;
  font-size: .6864rem
}

.form-material .form-control-sm:-webkit-autofill~.floating-label {
  top: -.6864rem;
  font-size: .6864rem
}

.form-material .form-control-lg~.floating-label {
  top: .428667rem;
  font-size: 1.286rem
}

.form-material .form-control-lg.focus~.floating-label,
.form-material .form-control-lg:focus~.floating-label,
.form-material .form-control-lg:not(.empty)~.floating-label {
  top: -1.0288rem;
  font-size: 1.0288rem
}

.form-material .form-control-lg:-webkit-autofill~.floating-label {
  top: -1.0288rem;
  font-size: 1.0288rem
}

.form-material .form-control.focus~.floating-label,
.form-material .form-control:focus~.floating-label,
.form-material .form-control:not(.empty)~.floating-label {
  font-weight: 500
}

.form-material .form-control:-webkit-autofill~.floating-label {
  font-weight: 500
}

.form-material .form-control.focus~.floating-label,
.form-material .form-control:focus~.floating-label {
  color: #3e8ef7
}

.form-material textarea.form-control {
  padding-bottom: .429rem;
  resize: none
}

.form-material.floating textarea.form-control {
  padding-top: .429rem
}

.form-material select.form-control {
  border: 0;
  border-radius: 0
}

.form-material:not(.floating) .form-control-label+select[multiple] {
  margin-top: 5px
}

.form-material .hint {
  position: absolute;
  display: none;
  font-size: 80%
}

.form-material .form-control.focus~.hint,
.form-material .form-control:focus~.hint {
  display: block
}

.form-material .form-control.focus:invalid~.floating-label,
.form-material .form-control:not(.empty):invalid~.floating-label {
  color: #ff4c52
}

.form-material .form-control:invalid {
  background-image: -webkit-gradient(linear, left top, left bottom, from(#ff4c52), to(#ff4c52)), -webkit-gradient(linear, left top, left bottom, from(#e4eaec), to(#e4eaec));
  background-image: -webkit-linear-gradient(#ff4c52, #ff4c52), -webkit-linear-gradient(#e4eaec, #e4eaec);
  background-image: -o-linear-gradient(#ff4c52, #ff4c52), -o-linear-gradient(#e4eaec, #e4eaec);
  background-image: linear-gradient(#ff4c52, #ff4c52), linear-gradient(#e4eaec, #e4eaec)
}

.form-material.has-warning .form-control.focus,
.form-material.has-warning .form-control:focus,
.form-material.has-warning .form-control:not(.empty) {
  background-image: -webkit-gradient(linear, left top, left bottom, from(#eb6709), to(#eb6709)), -webkit-gradient(linear, left top, left bottom, from(#e4eaec), to(#e4eaec));
  background-image: -webkit-linear-gradient(#eb6709, #eb6709), -webkit-linear-gradient(#e4eaec, #e4eaec);
  background-image: -o-linear-gradient(#eb6709, #eb6709), -o-linear-gradient(#e4eaec, #e4eaec);
  background-image: linear-gradient(#eb6709, #eb6709), linear-gradient(#e4eaec, #e4eaec)
}

.no-cssgradients .form-material.has-warning .form-control.focus,
.no-cssgradients .form-material.has-warning .form-control:focus,
.no-cssgradients .form-material.has-warning .form-control:not(.empty) {
  background: 0 0;
  border-bottom: 2px solid #eb6709
}

.form-material.has-warning .form-control:-webkit-autofill {
  background-image: -webkit-gradient(linear, left top, left bottom, from(#eb6709), to(#eb6709)), -webkit-gradient(linear, left top, left bottom, from(#e4eaec), to(#e4eaec));
  background-image: -webkit-linear-gradient(#eb6709, #eb6709), -webkit-linear-gradient(#e4eaec, #e4eaec);
  background-image: linear-gradient(#eb6709, #eb6709), linear-gradient(#e4eaec, #e4eaec)
}

.no-cssgradients .form-material.has-warning .form-control:-webkit-autofill {
  background: 0 0;
  border-bottom: 2px solid #eb6709
}

.form-material.has-warning .form-control:not(.empty) {
  -webkit-background-size: 100% 2px, 100% 1px;
  background-size: 100% 2px, 100% 1px
}

.form-material.has-warning .form-control-label {
  color: #eb6709
}

.form-material.has-warning .form-control.focus~.floating-label,
.form-material.has-warning .form-control:focus~.floating-label,
.form-material.has-warning .form-control:not(.empty)~.floating-label {
  color: #eb6709
}

.form-material.has-warning .form-control:-webkit-autofill~.floating-label {
  color: #eb6709
}

.form-material.has-danger .form-control.focus,
.form-material.has-danger .form-control:focus,
.form-material.has-danger .form-control:not(.empty) {
  background-image: -webkit-gradient(linear, left top, left bottom, from(#ff4c52), to(#ff4c52)), -webkit-gradient(linear, left top, left bottom, from(#e4eaec), to(#e4eaec));
  background-image: -webkit-linear-gradient(#ff4c52, #ff4c52), -webkit-linear-gradient(#e4eaec, #e4eaec);
  background-image: -o-linear-gradient(#ff4c52, #ff4c52), -o-linear-gradient(#e4eaec, #e4eaec);
  background-image: linear-gradient(#ff4c52, #ff4c52), linear-gradient(#e4eaec, #e4eaec)
}

.no-cssgradients .form-material.has-danger .form-control.focus,
.no-cssgradients .form-material.has-danger .form-control:focus,
.no-cssgradients .form-material.has-danger .form-control:not(.empty) {
  background: 0 0;
  border-bottom: 2px solid #ff4c52
}

.form-material.has-danger .form-control:-webkit-autofill {
  background-image: -webkit-gradient(linear, left top, left bottom, from(#ff4c52), to(#ff4c52)), -webkit-gradient(linear, left top, left bottom, from(#e4eaec), to(#e4eaec));
  background-image: -webkit-linear-gradient(#ff4c52, #ff4c52), -webkit-linear-gradient(#e4eaec, #e4eaec);
  background-image: linear-gradient(#ff4c52, #ff4c52), linear-gradient(#e4eaec, #e4eaec)
}

.no-cssgradients .form-material.has-danger .form-control:-webkit-autofill {
  background: 0 0;
  border-bottom: 2px solid #ff4c52
}

.form-material.has-danger .form-control:not(.empty) {
  -webkit-background-size: 100% 2px, 100% 1px;
  background-size: 100% 2px, 100% 1px
}

.form-material.has-danger .form-control-label {
  color: #ff4c52
}

.form-material.has-danger .form-control.focus~.floating-label,
.form-material.has-danger .form-control:focus~.floating-label,
.form-material.has-danger .form-control:not(.empty)~.floating-label {
  color: #ff4c52
}

.form-material.has-danger .form-control:-webkit-autofill~.floating-label {
  color: #ff4c52
}

.form-material.has-success .form-control.focus,
.form-material.has-success .form-control:focus,
.form-material.has-success .form-control:not(.empty) {
  background-image: -webkit-gradient(linear, left top, left bottom, from(#11c26d), to(#11c26d)), -webkit-gradient(linear, left top, left bottom, from(#e4eaec), to(#e4eaec));
  background-image: -webkit-linear-gradient(#11c26d, #11c26d), -webkit-linear-gradient(#e4eaec, #e4eaec);
  background-image: -o-linear-gradient(#11c26d, #11c26d), -o-linear-gradient(#e4eaec, #e4eaec);
  background-image: linear-gradient(#11c26d, #11c26d), linear-gradient(#e4eaec, #e4eaec)
}

.no-cssgradients .form-material.has-success .form-control.focus,
.no-cssgradients .form-material.has-success .form-control:focus,
.no-cssgradients .form-material.has-success .form-control:not(.empty) {
  background: 0 0;
  border-bottom: 2px solid #11c26d
}

.form-material.has-success .form-control:-webkit-autofill {
  background-image: -webkit-gradient(linear, left top, left bottom, from(#11c26d), to(#11c26d)), -webkit-gradient(linear, left top, left bottom, from(#e4eaec), to(#e4eaec));
  background-image: -webkit-linear-gradient(#11c26d, #11c26d), -webkit-linear-gradient(#e4eaec, #e4eaec);
  background-image: linear-gradient(#11c26d, #11c26d), linear-gradient(#e4eaec, #e4eaec)
}

.no-cssgradients .form-material.has-success .form-control:-webkit-autofill {
  background: 0 0;
  border-bottom: 2px solid #11c26d
}

.form-material.has-success .form-control:not(.empty) {
  -webkit-background-size: 100% 2px, 100% 1px;
  background-size: 100% 2px, 100% 1px
}

.form-material.has-success .form-control-label {
  color: #11c26d
}

.form-material.has-success .form-control.focus~.floating-label,
.form-material.has-success .form-control:focus~.floating-label,
.form-material.has-success .form-control:not(.empty)~.floating-label {
  color: #11c26d
}

.form-material.has-success .form-control:-webkit-autofill~.floating-label {
  color: #11c26d
}

.form-material.has-info .form-control.focus,
.form-material.has-info .form-control:focus,
.form-material.has-info .form-control:not(.empty) {
  background-image: -webkit-gradient(linear, left top, left bottom, from(#0bb2d4), to(#0bb2d4)), -webkit-gradient(linear, left top, left bottom, from(#e4eaec), to(#e4eaec));
  background-image: -webkit-linear-gradient(#0bb2d4, #0bb2d4), -webkit-linear-gradient(#e4eaec, #e4eaec);
  background-image: -o-linear-gradient(#0bb2d4, #0bb2d4), -o-linear-gradient(#e4eaec, #e4eaec);
  background-image: linear-gradient(#0bb2d4, #0bb2d4), linear-gradient(#e4eaec, #e4eaec)
}

.no-cssgradients .form-material.has-info .form-control.focus,
.no-cssgradients .form-material.has-info .form-control:focus,
.no-cssgradients .form-material.has-info .form-control:not(.empty) {
  background: 0 0;
  border-bottom: 2px solid #0bb2d4
}

.form-material.has-info .form-control:-webkit-autofill {
  background-image: -webkit-gradient(linear, left top, left bottom, from(#0bb2d4), to(#0bb2d4)), -webkit-gradient(linear, left top, left bottom, from(#e4eaec), to(#e4eaec));
  background-image: -webkit-linear-gradient(#0bb2d4, #0bb2d4), -webkit-linear-gradient(#e4eaec, #e4eaec);
  background-image: linear-gradient(#0bb2d4, #0bb2d4), linear-gradient(#e4eaec, #e4eaec)
}

.no-cssgradients .form-material.has-info .form-control:-webkit-autofill {
  background: 0 0;
  border-bottom: 2px solid #0bb2d4
}

.form-material.has-info .form-control:not(.empty) {
  -webkit-background-size: 100% 2px, 100% 1px;
  background-size: 100% 2px, 100% 1px
}

.form-material.has-info .form-control-label {
  color: #0bb2d4
}

.form-material.has-info .form-control.focus~.floating-label,
.form-material.has-info .form-control:focus~.floating-label,
.form-material.has-info .form-control:not(.empty)~.floating-label {
  color: #0bb2d4
}

.form-material.has-info .form-control:-webkit-autofill~.floating-label {
  color: #0bb2d4
}

.form-material .input-group .form-control-wrap {
  -webkit-box-flex: 1;
  -webkit-flex: 1 1 auto;
  -ms-flex: 1 1 auto;
  flex: 1 1 auto;
  margin-right: 5px;
  margin-left: 5px
}

.form-material .input-group .form-control-wrap .form-control {
  float: none;
  width: 100%
}

.form-material .input-group .input-group-addon {
  background: 0 0;
  border: 0
}

.form-material .input-group .input-group-btn .btn {
  margin: 0;
  border-radius: .286rem
}

.form-material input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 100;
  width: 100%;
  height: 100%;
  opacity: 0
}

.form-control-wrap {
  position: relative
}

.loader {
  position: relative;
  display: inline-block;
  margin: 0 auto;
  font-size: 40px;
  text-indent: -9999em;
  -webkit-transform: translateZ(0);
  transform: translateZ(0)
}

.loader-default {
  width: 1em;
  height: 1em;
  background-color: #a3afb7;
  border-radius: 100%;
  -webkit-animation: loader-default 1s infinite ease-in-out;
  -o-animation: loader-default 1s infinite ease-in-out;
  animation: loader-default 1s infinite ease-in-out
}

.loader-grill {
  width: .25em;
  height: .5em;
  background: #a3afb7;
  -webkit-animation: default-grill 1s infinite ease-in-out -.16s;
  -o-animation: default-grill 1s infinite ease-in-out -.16s;
  animation: default-grill 1s infinite ease-in-out -.16s
}

.loader-grill:after,
.loader-grill:before {
  position: absolute;
  top: 0;
  width: 100%;
  height: 100%;
  content: "";
  background: #a3afb7;
  -webkit-animation: default-grill 1s infinite ease-in-out;
  -o-animation: default-grill 1s infinite ease-in-out;
  animation: default-grill 1s infinite ease-in-out
}

.loader-grill:before {
  left: -.375em;
  -webkit-animation-delay: -.32s;
  -o-animation-delay: -.32s;
  animation-delay: -.32s
}

.loader-grill:after {
  left: .375em
}

.loader-circle {
  width: 1em;
  height: 1em;
  border-top: .125em solid rgba(163, 175, 183, .5);
  border-right: .125em solid rgba(163, 175, 183, .5);
  border-bottom: .125em solid rgba(163, 175, 183, .5);
  border-left: .125em solid #a3afb7;
  border-radius: 50%;
  -webkit-animation: loader-circle 1.1s infinite linear;
  -o-animation: loader-circle 1.1s infinite linear;
  animation: loader-circle 1.1s infinite linear
}

.loader-round-circle {
  width: 1em;
  height: 1em;
  font-size: 10px;
  border-radius: 50%;
  -webkit-animation: loader-round-circle 1.3s infinite linear;
  -o-animation: loader-round-circle 1.3s infinite linear;
  animation: loader-round-circle 1.3s infinite linear
}

.loader-tadpole {
  width: 1em;
  height: 1em;
  border-radius: 50%;
  -webkit-animation: loader-tadpole 1.7s infinite ease;
  -o-animation: loader-tadpole 1.7s infinite ease;
  animation: loader-tadpole 1.7s infinite ease
}

.loader-ellipsis {
  top: -.625em;
  width: .625em;
  height: .625em;
  border-radius: 50%;
  -webkit-animation: loader-ellipsis 1.8s infinite ease-in-out both -.16s;
  -o-animation: loader-ellipsis 1.8s infinite ease-in-out both -.16s;
  animation: loader-ellipsis 1.8s infinite ease-in-out both -.16s
}

.loader-ellipsis:after,
.loader-ellipsis:before {
  position: absolute;
  top: 0;
  width: 100%;
  height: 100%;
  content: "";
  border-radius: 50%;
  -webkit-animation: loader-ellipsis 1.8s infinite ease-in-out both;
  -o-animation: loader-ellipsis 1.8s infinite ease-in-out both;
  animation: loader-ellipsis 1.8s infinite ease-in-out both
}

.loader-ellipsis:before {
  left: -.875em;
  -webkit-animation-delay: -.32s;
  -o-animation-delay: -.32s;
  animation-delay: -.32s
}

.loader-ellipsis:after {
  left: .875em
}

.loader-dot {
  width: 2em;
  height: 2em;
  -webkit-animation: loader-dot-rotate 2s infinite linear;
  -o-animation: loader-dot-rotate 2s infinite linear;
  animation: loader-dot-rotate 2s infinite linear
}

.loader-dot:after,
.loader-dot:before {
  position: absolute;
  top: 0;
  left: 0;
  width: 60%;
  height: 60%;
  content: "";
  background: #a3afb7;
  border-radius: 100%;
  -webkit-animation: loader-dot-bounce 2s infinite ease-in-out;
  -o-animation: loader-dot-bounce 2s infinite ease-in-out;
  animation: loader-dot-bounce 2s infinite ease-in-out
}

.loader-dot:after {
  top: auto;
  bottom: 0;
  -webkit-animation-delay: -1s;
  -o-animation-delay: -1s;
  animation-delay: -1s
}

.loader-bounce {
  width: 1.5em;
  height: 1.5em
}

.loader-bounce:after,
.loader-bounce:before {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  content: "";
  background: #a3afb7;
  border-radius: 50%;
  opacity: .6;
  -webkit-animation: loader-bounce 2s infinite ease-in-out;
  -o-animation: loader-bounce 2s infinite ease-in-out;
  animation: loader-bounce 2s infinite ease-in-out
}

.loader-bounce:after {
  -webkit-animation-delay: -1s;
  -o-animation-delay: -1s;
  animation-delay: -1s
}

.loader-cube {
  width: 2em;
  height: 2em
}

.loader-cube:after,
.loader-cube:before {
  position: absolute;
  top: 0;
  left: 0;
  width: 25%;
  height: 25%;
  content: "";
  background: #a3afb7;
  -webkit-animation: loader-cube 2s infinite ease-in-out;
  -o-animation: loader-cube 2s infinite ease-in-out;
  animation: loader-cube 2s infinite ease-in-out
}

.loader-cube:after {
  -webkit-animation-delay: -1s;
  -o-animation-delay: -1s;
  animation-delay: -1s
}

.loader-rotate-plane {
  width: 1em;
  height: 1em;
  background: #a3afb7;
  -webkit-animation: loader-rotate-plane 1.2s infinite ease-in-out;
  -o-animation: loader-rotate-plane 1.2s infinite ease-in-out;
  animation: loader-rotate-plane 1.2s infinite ease-in-out
}

.loader-folding-cube {
  width: .8em;
  height: .8em;
  -webkit-transform: rotate(45deg) translateZ(0);
  transform: rotate(45deg) translateZ(0)
}

.loader-folding-cube:after,
.loader-folding-cube:before {
  position: absolute;
  width: 0;
  height: 0;
  content: "";
  background: #a3afb7
}

.loader-folding-cube:before {
  bottom: 50%;
  left: 0;
  -webkit-animation: loader-folding-cube-before 2.4s infinite ease-in-out;
  -o-animation: loader-folding-cube-before 2.4s infinite ease-in-out;
  animation: loader-folding-cube-before 2.4s infinite ease-in-out;
  -webkit-animation-delay: -.6s;
  -o-animation-delay: -.6s;
  animation-delay: -.6s
}

.loader-folding-cube:after {
  top: 50%;
  right: 0;
  -webkit-animation: loader-folding-cube-after 2.4s infinite ease-in-out;
  -o-animation: loader-folding-cube-after 2.4s infinite ease-in-out;
  animation: loader-folding-cube-after 2.4s infinite ease-in-out
}

.loader-cube-grid {
  top: -.6em;
  width: .3em;
  height: .3em;
  -webkit-animation: loader-cube-grid 1.2s infinite ease-in-out;
  -o-animation: loader-cube-grid 1.2s infinite ease-in-out;
  animation: loader-cube-grid 1.2s infinite ease-in-out
}

.loader-cube-grid:after,
.loader-cube-grid:before {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  content: ""
}

.loader-cube-grid:before {
  -webkit-animation: loader-cube-grid-before 1.2s infinite ease-in-out;
  -o-animation: loader-cube-grid-before 1.2s infinite ease-in-out;
  animation: loader-cube-grid-before 1.2s infinite ease-in-out
}

.loader-cube-grid:after {
  -webkit-animation: loader-cube-grid-after 1.2s infinite ease-in-out;
  -o-animation: loader-cube-grid-after 1.2s infinite ease-in-out;
  animation: loader-cube-grid-after 1.2s infinite ease-in-out
}

.side-panel-loading,
body>.loader {
  position: fixed;
  top: 50%;
  left: 50%;
  margin-top: -20px
}

.site-menubar-unfold>.loader {
  margin-left: 130px
}

.site-menubar-fold>.loader {
  margin-left: 45px
}

.site-menubar-hide.site-menubar-unfold>.loader {
  margin-left: 0
}

.loader-overlay {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 999999;
  width: 100%;
  height: 100%;
  background: #3e8ef7
}

.loader-content {
  margin: 50vh auto 0;
  text-align: center;
  text-transform: uppercase;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%)
}

.loader-content h2 {
  font-weight: 500;
  color: #fff
}

.loader-index {
  margin-top: 20px
}

.loader-index>div {
  display: inline-block;
  width: 4px;
  height: 25px;
  margin: 2px;
  background: #fff;
  border-radius: 2px;
  -webkit-animation: loader-index .9s -.8s infinite cubic-bezier(.85, .25, .37, .85);
  -o-animation: loader-index .9s -.8s infinite cubic-bezier(.85, .25, .37, .85);
  animation: loader-index .9s -.8s infinite cubic-bezier(.85, .25, .37, .85);
  -webkit-animation-fill-mode: both;
  -o-animation-fill-mode: both;
  animation-fill-mode: both
}

.loader-index>div:nth-child(2),
.loader-index>div:nth-child(4) {
  -webkit-animation-delay: -.6s !important;
  -o-animation-delay: -.6s !important;
  animation-delay: -.6s !important
}

.loader-index>div:nth-child(1),
.loader-index>div:nth-child(5) {
  -webkit-animation-delay: -.4s !important;
  -o-animation-delay: -.4s !important;
  animation-delay: -.4s !important
}

.loader-index>div:nth-child(6) {
  -webkit-animation-delay: -.2s !important;
  -o-animation-delay: -.2s !important;
  animation-delay: -.2s !important
}

@-webkit-keyframes loader-index {
  0% {
    -webkit-transform: scaleY(1);
    transform: scaleY(1)
  }

  50% {
    -webkit-transform: scaleY(.4);
    transform: scaleY(.4)
  }

  100% {
    -webkit-transform: scaleY(1);
    transform: scaleY(1)
  }
}

@-o-keyframes loader-index {
  0% {
    -o-transform: scaleY(1);
    transform: scaleY(1)
  }

  50% {
    -o-transform: scaleY(.4);
    transform: scaleY(.4)
  }

  100% {
    -o-transform: scaleY(1);
    transform: scaleY(1)
  }
}

@keyframes loader-index {
  0% {
    -webkit-transform: scaleY(1);
    -o-transform: scaleY(1);
    transform: scaleY(1)
  }

  50% {
    -webkit-transform: scaleY(.4);
    -o-transform: scaleY(.4);
    transform: scaleY(.4)
  }

  100% {
    -webkit-transform: scaleY(1);
    -o-transform: scaleY(1);
    transform: scaleY(1)
  }
}

@-webkit-keyframes loader-default {
  0% {
    -webkit-transform: scale(0);
    transform: scale(0)
  }

  100% {
    opacity: 0;
    -webkit-transform: scale(1);
    transform: scale(1)
  }
}

@-o-keyframes loader-default {
  0% {
    -o-transform: scale(0);
    transform: scale(0)
  }

  100% {
    opacity: 0;
    -o-transform: scale(1);
    transform: scale(1)
  }
}

@keyframes loader-default {
  0% {
    -webkit-transform: scale(0);
    -o-transform: scale(0);
    transform: scale(0)
  }

  100% {
    opacity: 0;
    -webkit-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1)
  }
}

@-webkit-keyframes default-grill {

  0%,
  100%,
  80% {
    height: 1em;
    -webkit-box-shadow: 0 0 #a3afb7;
    box-shadow: 0 0 #a3afb7
  }

  40% {
    height: 1.2em;
    -webkit-box-shadow: 0 -.25em #a3afb7;
    box-shadow: 0 -.25em #a3afb7
  }
}

@-o-keyframes default-grill {

  0%,
  100%,
  80% {
    height: 1em;
    box-shadow: 0 0 #a3afb7
  }

  40% {
    height: 1.2em;
    box-shadow: 0 -.25em #a3afb7
  }
}

@keyframes default-grill {

  0%,
  100%,
  80% {
    height: 1em;
    -webkit-box-shadow: 0 0 #a3afb7;
    box-shadow: 0 0 #a3afb7
  }

  40% {
    height: 1.2em;
    -webkit-box-shadow: 0 -.25em #a3afb7;
    box-shadow: 0 -.25em #a3afb7
  }
}

@-webkit-keyframes loader-circle {
  0% {
    -webkit-transform: rotate(0);
    transform: rotate(0)
  }

  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg)
  }
}

@-o-keyframes loader-circle {
  0% {
    -o-transform: rotate(0);
    transform: rotate(0)
  }

  100% {
    -o-transform: rotate(360deg);
    transform: rotate(360deg)
  }
}

@keyframes loader-circle {
  0% {
    -webkit-transform: rotate(0);
    -o-transform: rotate(0);
    transform: rotate(0)
  }

  100% {
    -webkit-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg)
  }
}

@-webkit-keyframes loader-round-circle {

  0%,
  100% {
    -webkit-box-shadow: 0 -3em 0 .2em #a3afb7, 2em -2em 0 0 #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 0 #a3afb7;
    box-shadow: 0 -3em 0 .2em #a3afb7, 2em -2em 0 0 #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 0 #a3afb7
  }

  12.5% {
    -webkit-box-shadow: 0 -3em 0 0 #a3afb7, 2em -2em 0 .2em #a3afb7, 3em 0 0 0 #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7;
    box-shadow: 0 -3em 0 0 #a3afb7, 2em -2em 0 .2em #a3afb7, 3em 0 0 0 #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7
  }

  25% {
    -webkit-box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 0 #a3afb7, 3em 0 0 .2em #a3afb7, 2em 2em 0 0 #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7;
    box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 0 #a3afb7, 3em 0 0 .2em #a3afb7, 2em 2em 0 0 #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7
  }

  37.5% {
    -webkit-box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 0 #a3afb7, 2em 2em 0 .2em #a3afb7, 0 3em 0 0 #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7;
    box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 0 #a3afb7, 2em 2em 0 .2em #a3afb7, 0 3em 0 0 #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7
  }

  50% {
    -webkit-box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 0 #a3afb7, 0 3em 0 .2em #a3afb7, -2em 2em 0 0 #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7;
    box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 0 #a3afb7, 0 3em 0 .2em #a3afb7, -2em 2em 0 0 #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7
  }

  62.5% {
    -webkit-box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 0 #a3afb7, -2em 2em 0 .2em #a3afb7, -3em 0 0 0 #a3afb7, -2em -2em 0 -.5em #a3afb7;
    box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 0 #a3afb7, -2em 2em 0 .2em #a3afb7, -3em 0 0 0 #a3afb7, -2em -2em 0 -.5em #a3afb7
  }

  75% {
    -webkit-box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 0 #a3afb7, -3em 0 0 .2em #a3afb7, -2em -2em 0 0 #a3afb7;
    box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 0 #a3afb7, -3em 0 0 .2em #a3afb7, -2em -2em 0 0 #a3afb7
  }

  87.5% {
    -webkit-box-shadow: 0 -3em 0 0 #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 0 #a3afb7, -3em 0 0 0 #a3afb7, -2em -2em 0 .2em #a3afb7;
    box-shadow: 0 -3em 0 0 #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 0 #a3afb7, -3em 0 0 0 #a3afb7, -2em -2em 0 .2em #a3afb7
  }
}

@-o-keyframes loader-round-circle {

  0%,
  100% {
    box-shadow: 0 -3em 0 .2em #a3afb7, 2em -2em 0 0 #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 0 #a3afb7
  }

  12.5% {
    box-shadow: 0 -3em 0 0 #a3afb7, 2em -2em 0 .2em #a3afb7, 3em 0 0 0 #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7
  }

  25% {
    box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 0 #a3afb7, 3em 0 0 .2em #a3afb7, 2em 2em 0 0 #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7
  }

  37.5% {
    box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 0 #a3afb7, 2em 2em 0 .2em #a3afb7, 0 3em 0 0 #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7
  }

  50% {
    box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 0 #a3afb7, 0 3em 0 .2em #a3afb7, -2em 2em 0 0 #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7
  }

  62.5% {
    box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 0 #a3afb7, -2em 2em 0 .2em #a3afb7, -3em 0 0 0 #a3afb7, -2em -2em 0 -.5em #a3afb7
  }

  75% {
    box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 0 #a3afb7, -3em 0 0 .2em #a3afb7, -2em -2em 0 0 #a3afb7
  }

  87.5% {
    box-shadow: 0 -3em 0 0 #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 0 #a3afb7, -3em 0 0 0 #a3afb7, -2em -2em 0 .2em #a3afb7
  }
}

@keyframes loader-round-circle {

  0%,
  100% {
    -webkit-box-shadow: 0 -3em 0 .2em #a3afb7, 2em -2em 0 0 #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 0 #a3afb7;
    box-shadow: 0 -3em 0 .2em #a3afb7, 2em -2em 0 0 #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 0 #a3afb7
  }

  12.5% {
    -webkit-box-shadow: 0 -3em 0 0 #a3afb7, 2em -2em 0 .2em #a3afb7, 3em 0 0 0 #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7;
    box-shadow: 0 -3em 0 0 #a3afb7, 2em -2em 0 .2em #a3afb7, 3em 0 0 0 #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7
  }

  25% {
    -webkit-box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 0 #a3afb7, 3em 0 0 .2em #a3afb7, 2em 2em 0 0 #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7;
    box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 0 #a3afb7, 3em 0 0 .2em #a3afb7, 2em 2em 0 0 #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7
  }

  37.5% {
    -webkit-box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 0 #a3afb7, 2em 2em 0 .2em #a3afb7, 0 3em 0 0 #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7;
    box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 0 #a3afb7, 2em 2em 0 .2em #a3afb7, 0 3em 0 0 #a3afb7, -2em 2em 0 -.5em #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7
  }

  50% {
    -webkit-box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 0 #a3afb7, 0 3em 0 .2em #a3afb7, -2em 2em 0 0 #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7;
    box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 0 #a3afb7, 0 3em 0 .2em #a3afb7, -2em 2em 0 0 #a3afb7, -3em 0 0 -.5em #a3afb7, -2em -2em 0 -.5em #a3afb7
  }

  62.5% {
    -webkit-box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 0 #a3afb7, -2em 2em 0 .2em #a3afb7, -3em 0 0 0 #a3afb7, -2em -2em 0 -.5em #a3afb7;
    box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 0 #a3afb7, -2em 2em 0 .2em #a3afb7, -3em 0 0 0 #a3afb7, -2em -2em 0 -.5em #a3afb7
  }

  75% {
    -webkit-box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 0 #a3afb7, -3em 0 0 .2em #a3afb7, -2em -2em 0 0 #a3afb7;
    box-shadow: 0 -3em 0 -.5em #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 0 #a3afb7, -3em 0 0 .2em #a3afb7, -2em -2em 0 0 #a3afb7
  }

  87.5% {
    -webkit-box-shadow: 0 -3em 0 0 #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 0 #a3afb7, -3em 0 0 0 #a3afb7, -2em -2em 0 .2em #a3afb7;
    box-shadow: 0 -3em 0 0 #a3afb7, 2em -2em 0 -.5em #a3afb7, 3em 0 0 -.5em #a3afb7, 2em 2em 0 -.5em #a3afb7, 0 3em 0 -.5em #a3afb7, -2em 2em 0 0 #a3afb7, -3em 0 0 0 #a3afb7, -2em -2em 0 .2em #a3afb7
  }
}

@-webkit-keyframes loader-tadpole {
  0% {
    -webkit-box-shadow: 0 -.83em 0 -.4em #a3afb7, 0 -.83em 0 -.42em #a3afb7, 0 -.83em 0 -.44em #a3afb7, 0 -.83em 0 -.46em #a3afb7, 0 -.83em 0 -.477em #a3afb7;
    box-shadow: 0 -.83em 0 -.4em #a3afb7, 0 -.83em 0 -.42em #a3afb7, 0 -.83em 0 -.44em #a3afb7, 0 -.83em 0 -.46em #a3afb7, 0 -.83em 0 -.477em #a3afb7;
    -webkit-transform: rotate(0);
    transform: rotate(0)
  }

  5%,
  95% {
    -webkit-box-shadow: 0 -.83em 0 -.4em #a3afb7, 0 -.83em 0 -.42em #a3afb7, 0 -.83em 0 -.44em #a3afb7, 0 -.83em 0 -.46em #a3afb7, 0 -.83em 0 -.477em #a3afb7;
    box-shadow: 0 -.83em 0 -.4em #a3afb7, 0 -.83em 0 -.42em #a3afb7, 0 -.83em 0 -.44em #a3afb7, 0 -.83em 0 -.46em #a3afb7, 0 -.83em 0 -.477em #a3afb7
  }

  10%,
  59% {
    -webkit-box-shadow: 0 -.83em 0 -.4em #a3afb7, -.087em -.825em 0 -.42em #a3afb7, -.173em -.812em 0 -.44em #a3afb7, -.256em -.789em 0 -.46em #a3afb7, -.297em -.775em 0 -.477em #a3afb7;
    box-shadow: 0 -.83em 0 -.4em #a3afb7, -.087em -.825em 0 -.42em #a3afb7, -.173em -.812em 0 -.44em #a3afb7, -.256em -.789em 0 -.46em #a3afb7, -.297em -.775em 0 -.477em #a3afb7
  }

  20% {
    -webkit-box-shadow: 0 -.83em 0 -.4em #a3afb7, -.338em -.758em 0 -.42em #a3afb7, -.555em -.617em 0 -.44em #a3afb7, -.671em -.488em 0 -.46em #a3afb7, -.749em -.34em 0 -.477em #a3afb7;
    box-shadow: 0 -.83em 0 -.4em #a3afb7, -.338em -.758em 0 -.42em #a3afb7, -.555em -.617em 0 -.44em #a3afb7, -.671em -.488em 0 -.46em #a3afb7, -.749em -.34em 0 -.477em #a3afb7
  }

  38% {
    -webkit-box-shadow: 0 -.83em 0 -.4em #a3afb7, -.377em -.74em 0 -.42em #a3afb7, -.645em -.522em 0 -.44em #a3afb7, -.775em -.297em 0 -.46em #a3afb7, -.82em -.09em 0 -.477em #a3afb7;
    box-shadow: 0 -.83em 0 -.4em #a3afb7, -.377em -.74em 0 -.42em #a3afb7, -.645em -.522em 0 -.44em #a3afb7, -.775em -.297em 0 -.46em #a3afb7, -.82em -.09em 0 -.477em #a3afb7
  }

  100% {
    -webkit-box-shadow: 0 -.83em 0 -.4em #a3afb7, 0 -.83em 0 -.42em #a3afb7, 0 -.83em 0 -.44em #a3afb7, 0 -.83em 0 -.46em #a3afb7, 0 -.83em 0 -.477em #a3afb7;
    box-shadow: 0 -.83em 0 -.4em #a3afb7, 0 -.83em 0 -.42em #a3afb7, 0 -.83em 0 -.44em #a3afb7, 0 -.83em 0 -.46em #a3afb7, 0 -.83em 0 -.477em #a3afb7;
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg)
  }
}

@-o-keyframes loader-tadpole {
  0% {
    box-shadow: 0 -.83em 0 -.4em #a3afb7, 0 -.83em 0 -.42em #a3afb7, 0 -.83em 0 -.44em #a3afb7, 0 -.83em 0 -.46em #a3afb7, 0 -.83em 0 -.477em #a3afb7;
    -o-transform: rotate(0);
    transform: rotate(0)
  }

  5%,
  95% {
    box-shadow: 0 -.83em 0 -.4em #a3afb7, 0 -.83em 0 -.42em #a3afb7, 0 -.83em 0 -.44em #a3afb7, 0 -.83em 0 -.46em #a3afb7, 0 -.83em 0 -.477em #a3afb7
  }

  10%,
  59% {
    box-shadow: 0 -.83em 0 -.4em #a3afb7, -.087em -.825em 0 -.42em #a3afb7, -.173em -.812em 0 -.44em #a3afb7, -.256em -.789em 0 -.46em #a3afb7, -.297em -.775em 0 -.477em #a3afb7
  }

  20% {
    box-shadow: 0 -.83em 0 -.4em #a3afb7, -.338em -.758em 0 -.42em #a3afb7, -.555em -.617em 0 -.44em #a3afb7, -.671em -.488em 0 -.46em #a3afb7, -.749em -.34em 0 -.477em #a3afb7
  }

  38% {
    box-shadow: 0 -.83em 0 -.4em #a3afb7, -.377em -.74em 0 -.42em #a3afb7, -.645em -.522em 0 -.44em #a3afb7, -.775em -.297em 0 -.46em #a3afb7, -.82em -.09em 0 -.477em #a3afb7
  }

  100% {
    box-shadow: 0 -.83em 0 -.4em #a3afb7, 0 -.83em 0 -.42em #a3afb7, 0 -.83em 0 -.44em #a3afb7, 0 -.83em 0 -.46em #a3afb7, 0 -.83em 0 -.477em #a3afb7;
    -o-transform: rotate(360deg);
    transform: rotate(360deg)
  }
}

@keyframes loader-tadpole {
  0% {
    -webkit-box-shadow: 0 -.83em 0 -.4em #a3afb7, 0 -.83em 0 -.42em #a3afb7, 0 -.83em 0 -.44em #a3afb7, 0 -.83em 0 -.46em #a3afb7, 0 -.83em 0 -.477em #a3afb7;
    box-shadow: 0 -.83em 0 -.4em #a3afb7, 0 -.83em 0 -.42em #a3afb7, 0 -.83em 0 -.44em #a3afb7, 0 -.83em 0 -.46em #a3afb7, 0 -.83em 0 -.477em #a3afb7;
    -webkit-transform: rotate(0);
    -o-transform: rotate(0);
    transform: rotate(0)
  }

  5%,
  95% {
    -webkit-box-shadow: 0 -.83em 0 -.4em #a3afb7, 0 -.83em 0 -.42em #a3afb7, 0 -.83em 0 -.44em #a3afb7, 0 -.83em 0 -.46em #a3afb7, 0 -.83em 0 -.477em #a3afb7;
    box-shadow: 0 -.83em 0 -.4em #a3afb7, 0 -.83em 0 -.42em #a3afb7, 0 -.83em 0 -.44em #a3afb7, 0 -.83em 0 -.46em #a3afb7, 0 -.83em 0 -.477em #a3afb7
  }

  10%,
  59% {
    -webkit-box-shadow: 0 -.83em 0 -.4em #a3afb7, -.087em -.825em 0 -.42em #a3afb7, -.173em -.812em 0 -.44em #a3afb7, -.256em -.789em 0 -.46em #a3afb7, -.297em -.775em 0 -.477em #a3afb7;
    box-shadow: 0 -.83em 0 -.4em #a3afb7, -.087em -.825em 0 -.42em #a3afb7, -.173em -.812em 0 -.44em #a3afb7, -.256em -.789em 0 -.46em #a3afb7, -.297em -.775em 0 -.477em #a3afb7
  }

  20% {
    -webkit-box-shadow: 0 -.83em 0 -.4em #a3afb7, -.338em -.758em 0 -.42em #a3afb7, -.555em -.617em 0 -.44em #a3afb7, -.671em -.488em 0 -.46em #a3afb7, -.749em -.34em 0 -.477em #a3afb7;
    box-shadow: 0 -.83em 0 -.4em #a3afb7, -.338em -.758em 0 -.42em #a3afb7, -.555em -.617em 0 -.44em #a3afb7, -.671em -.488em 0 -.46em #a3afb7, -.749em -.34em 0 -.477em #a3afb7
  }

  38% {
    -webkit-box-shadow: 0 -.83em 0 -.4em #a3afb7, -.377em -.74em 0 -.42em #a3afb7, -.645em -.522em 0 -.44em #a3afb7, -.775em -.297em 0 -.46em #a3afb7, -.82em -.09em 0 -.477em #a3afb7;
    box-shadow: 0 -.83em 0 -.4em #a3afb7, -.377em -.74em 0 -.42em #a3afb7, -.645em -.522em 0 -.44em #a3afb7, -.775em -.297em 0 -.46em #a3afb7, -.82em -.09em 0 -.477em #a3afb7
  }

  100% {
    -webkit-box-shadow: 0 -.83em 0 -.4em #a3afb7, 0 -.83em 0 -.42em #a3afb7, 0 -.83em 0 -.44em #a3afb7, 0 -.83em 0 -.46em #a3afb7, 0 -.83em 0 -.477em #a3afb7;
    box-shadow: 0 -.83em 0 -.4em #a3afb7, 0 -.83em 0 -.42em #a3afb7, 0 -.83em 0 -.44em #a3afb7, 0 -.83em 0 -.46em #a3afb7, 0 -.83em 0 -.477em #a3afb7;
    -webkit-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg)
  }
}

@-webkit-keyframes loader-ellipsis {

  0%,
  100%,
  80% {
    -webkit-box-shadow: 0 .625em 0 -.325em #a3afb7;
    box-shadow: 0 .625em 0 -.325em #a3afb7
  }

  40% {
    -webkit-box-shadow: 0 .625em 0 0 #a3afb7;
    box-shadow: 0 .625em 0 0 #a3afb7
  }
}

@-o-keyframes loader-ellipsis {

  0%,
  100%,
  80% {
    box-shadow: 0 .625em 0 -.325em #a3afb7
  }

  40% {
    box-shadow: 0 .625em 0 0 #a3afb7
  }
}

@keyframes loader-ellipsis {

  0%,
  100%,
  80% {
    -webkit-box-shadow: 0 .625em 0 -.325em #a3afb7;
    box-shadow: 0 .625em 0 -.325em #a3afb7
  }

  40% {
    -webkit-box-shadow: 0 .625em 0 0 #a3afb7;
    box-shadow: 0 .625em 0 0 #a3afb7
  }
}

@-webkit-keyframes loader-dot-rotate {
  0% {
    -webkit-transform: rotate(0);
    transform: rotate(0)
  }

  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg)
  }
}

@-o-keyframes loader-dot-rotate {
  0% {
    -o-transform: rotate(0);
    transform: rotate(0)
  }

  100% {
    -o-transform: rotate(360deg);
    transform: rotate(360deg)
  }
}

@keyframes loader-dot-rotate {
  0% {
    -webkit-transform: rotate(0);
    -o-transform: rotate(0);
    transform: rotate(0)
  }

  100% {
    -webkit-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg)
  }
}

@-webkit-keyframes loader-dot-bounce {

  0%,
  100% {
    -webkit-transform: scale(0);
    transform: scale(0)
  }

  50% {
    -webkit-transform: scale(1);
    transform: scale(1)
  }
}

@-o-keyframes loader-dot-bounce {

  0%,
  100% {
    -o-transform: scale(0);
    transform: scale(0)
  }

  50% {
    -o-transform: scale(1);
    transform: scale(1)
  }
}

@keyframes loader-dot-bounce {

  0%,
  100% {
    -webkit-transform: scale(0);
    -o-transform: scale(0);
    transform: scale(0)
  }

  50% {
    -webkit-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1)
  }
}

@-webkit-keyframes loader-bounce {

  0%,
  100% {
    -webkit-transform: scale(0);
    transform: scale(0)
  }

  50% {
    -webkit-transform: scale(1);
    transform: scale(1)
  }
}

@-o-keyframes loader-bounce {

  0%,
  100% {
    -o-transform: scale(0);
    transform: scale(0)
  }

  50% {
    -o-transform: scale(1);
    transform: scale(1)
  }
}

@keyframes loader-bounce {

  0%,
  100% {
    -webkit-transform: scale(0);
    -o-transform: scale(0);
    transform: scale(0)
  }

  50% {
    -webkit-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1)
  }
}

@-webkit-keyframes loader-cube {
  0% {
    -webkit-transform: rotate(0);
    transform: rotate(0)
  }

  25% {
    -webkit-transform: translateX(1.5em) rotate(-90deg) scale(.5);
    transform: translateX(1.5em) rotate(-90deg) scale(.5)
  }

  50% {
    -webkit-transform: translateX(1.5em) translateY(1.5em) rotate(-179deg);
    transform: translateX(1.5em) translateY(1.5em) rotate(-179deg)
  }

  50.1% {
    -webkit-transform: translateX(1.5em) translateY(1.5em) rotate(-180deg);
    transform: translateX(1.5em) translateY(1.5em) rotate(-180deg)
  }

  75% {
    -webkit-transform: translateX(0) translateY(1.5em) rotate(-270deg) scale(.5);
    transform: translateX(0) translateY(1.5em) rotate(-270deg) scale(.5)
  }

  100% {
    -webkit-transform: rotate(-360deg);
    transform: rotate(-360deg)
  }
}

@-o-keyframes loader-cube {
  0% {
    -o-transform: rotate(0);
    transform: rotate(0)
  }

  25% {
    -o-transform: translateX(1.5em) rotate(-90deg) scale(.5);
    transform: translateX(1.5em) rotate(-90deg) scale(.5)
  }

  50% {
    -o-transform: translateX(1.5em) translateY(1.5em) rotate(-179deg);
    transform: translateX(1.5em) translateY(1.5em) rotate(-179deg)
  }

  50.1% {
    -o-transform: translateX(1.5em) translateY(1.5em) rotate(-180deg);
    transform: translateX(1.5em) translateY(1.5em) rotate(-180deg)
  }

  75% {
    -o-transform: translateX(0) translateY(1.5em) rotate(-270deg) scale(.5);
    transform: translateX(0) translateY(1.5em) rotate(-270deg) scale(.5)
  }

  100% {
    -o-transform: rotate(-360deg);
    transform: rotate(-360deg)
  }
}

@keyframes loader-cube {
  0% {
    -webkit-transform: rotate(0);
    -o-transform: rotate(0);
    transform: rotate(0)
  }

  25% {
    -webkit-transform: translateX(1.5em) rotate(-90deg) scale(.5);
    -o-transform: translateX(1.5em) rotate(-90deg) scale(.5);
    transform: translateX(1.5em) rotate(-90deg) scale(.5)
  }

  50% {
    -webkit-transform: translateX(1.5em) translateY(1.5em) rotate(-179deg);
    -o-transform: translateX(1.5em) translateY(1.5em) rotate(-179deg);
    transform: translateX(1.5em) translateY(1.5em) rotate(-179deg)
  }

  50.1% {
    -webkit-transform: translateX(1.5em) translateY(1.5em) rotate(-180deg);
    -o-transform: translateX(1.5em) translateY(1.5em) rotate(-180deg);
    transform: translateX(1.5em) translateY(1.5em) rotate(-180deg)
  }

  75% {
    -webkit-transform: translateX(0) translateY(1.5em) rotate(-270deg) scale(.5);
    -o-transform: translateX(0) translateY(1.5em) rotate(-270deg) scale(.5);
    transform: translateX(0) translateY(1.5em) rotate(-270deg) scale(.5)
  }

  100% {
    -webkit-transform: rotate(-360deg);
    -o-transform: rotate(-360deg);
    transform: rotate(-360deg)
  }
}

@-webkit-keyframes loader-rotate-plane {
  0% {
    -webkit-transform: perspective(120px) rotateX(0) rotateY(0);
    transform: perspective(120px) rotateX(0) rotateY(0)
  }

  50% {
    -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0);
    transform: perspective(120px) rotateX(-180.1deg) rotateY(0)
  }

  100% {
    -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
    transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg)
  }
}

@-o-keyframes loader-rotate-plane {
  0% {
    transform: perspective(120px) rotateX(0) rotateY(0)
  }

  50% {
    transform: perspective(120px) rotateX(-180.1deg) rotateY(0)
  }

  100% {
    transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg)
  }
}

@keyframes loader-rotate-plane {
  0% {
    -webkit-transform: perspective(120px) rotateX(0) rotateY(0);
    transform: perspective(120px) rotateX(0) rotateY(0)
  }

  50% {
    -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0);
    transform: perspective(120px) rotateX(-180.1deg) rotateY(0)
  }

  100% {
    -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
    transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg)
  }
}

@-webkit-keyframes loader-folding-cube-before {
  0% {
    width: 50%;
    height: 0
  }

  7.5% {
    width: 50%;
    height: 50%
  }

  12.5% {
    width: 50%;
    height: 50%
  }

  20% {
    width: 100%;
    height: 50%
  }

  25% {
    width: 100%;
    height: 50%
  }

  50% {
    right: 0;
    left: auto;
    width: 100%;
    height: 50%
  }

  57.5% {
    width: 50%;
    height: 50%
  }

  62.5% {
    width: 50%;
    height: 50%
  }

  70% {
    width: 50%;
    height: 0
  }

  75% {
    width: 50%;
    height: 0
  }
}

@-o-keyframes loader-folding-cube-before {
  0% {
    width: 50%;
    height: 0
  }

  7.5% {
    width: 50%;
    height: 50%
  }

  12.5% {
    width: 50%;
    height: 50%
  }

  20% {
    width: 100%;
    height: 50%
  }

  25% {
    width: 100%;
    height: 50%
  }

  50% {
    right: 0;
    left: auto;
    width: 100%;
    height: 50%
  }

  57.5% {
    width: 50%;
    height: 50%
  }

  62.5% {
    width: 50%;
    height: 50%
  }

  70% {
    width: 50%;
    height: 0
  }

  75% {
    width: 50%;
    height: 0
  }
}

@keyframes loader-folding-cube-before {
  0% {
    width: 50%;
    height: 0
  }

  7.5% {
    width: 50%;
    height: 50%
  }

  12.5% {
    width: 50%;
    height: 50%
  }

  20% {
    width: 100%;
    height: 50%
  }

  25% {
    width: 100%;
    height: 50%
  }

  50% {
    right: 0;
    left: auto;
    width: 100%;
    height: 50%
  }

  57.5% {
    width: 50%;
    height: 50%
  }

  62.5% {
    width: 50%;
    height: 50%
  }

  70% {
    width: 50%;
    height: 0
  }

  75% {
    width: 50%;
    height: 0
  }
}

@-webkit-keyframes loader-folding-cube-after {
  0% {
    width: 50%;
    height: 0
  }

  7.5% {
    width: 50%;
    height: 50%
  }

  12.5% {
    width: 50%;
    height: 50%
  }

  20% {
    width: 100%;
    height: 50%
  }

  25% {
    width: 100%;
    height: 50%
  }

  50% {
    right: auto;
    left: 0;
    width: 100%;
    height: 50%
  }

  57.5% {
    width: 50%;
    height: 50%
  }

  62.5% {
    width: 50%;
    height: 50%
  }

  75% {
    width: 50%;
    height: 0
  }
}

@-o-keyframes loader-folding-cube-after {
  0% {
    width: 50%;
    height: 0
  }

  7.5% {
    width: 50%;
    height: 50%
  }

  12.5% {
    width: 50%;
    height: 50%
  }

  20% {
    width: 100%;
    height: 50%
  }

  25% {
    width: 100%;
    height: 50%
  }

  50% {
    right: auto;
    left: 0;
    width: 100%;
    height: 50%
  }

  57.5% {
    width: 50%;
    height: 50%
  }

  62.5% {
    width: 50%;
    height: 50%
  }

  75% {
    width: 50%;
    height: 0
  }
}

@keyframes loader-folding-cube-after {
  0% {
    width: 50%;
    height: 0
  }

  7.5% {
    width: 50%;
    height: 50%
  }

  12.5% {
    width: 50%;
    height: 50%
  }

  20% {
    width: 100%;
    height: 50%
  }

  25% {
    width: 100%;
    height: 50%
  }

  50% {
    right: auto;
    left: 0;
    width: 100%;
    height: 50%
  }

  57.5% {
    width: 50%;
    height: 50%
  }

  62.5% {
    width: 50%;
    height: 50%
  }

  75% {
    width: 50%;
    height: 0
  }
}

@-webkit-keyframes loader-cube-grid {
  15% {
    -webkit-box-shadow: -.3em .3em 0 -.3em #a3afb7, 0 .6em 0 -.3em #a3afb7, .3em .9em 0 -.3em #a3afb7;
    box-shadow: -.3em .3em 0 -.3em #a3afb7, 0 .6em 0 -.3em #a3afb7, .3em .9em 0 -.3em #a3afb7
  }

  30% {
    -webkit-box-shadow: -.3em .3em 0 0 #a3afb7, 0 .6em 0 0 #a3afb7, .3em .9em 0 0 #a3afb7;
    box-shadow: -.3em .3em 0 0 #a3afb7, 0 .6em 0 0 #a3afb7, .3em .9em 0 0 #a3afb7
  }

  70% {
    -webkit-box-shadow: -.3em .3em 0 0 #a3afb7, 0 .6em 0 0 #a3afb7, .3em .9em 0 0 #a3afb7;
    box-shadow: -.3em .3em 0 0 #a3afb7, 0 .6em 0 0 #a3afb7, .3em .9em 0 0 #a3afb7
  }

  85% {
    -webkit-box-shadow: -.3em .3em 0 -.3em #a3afb7, 0 .6em 0 -.3em #a3afb7, .3em .9em 0 -.3em #a3afb7;
    box-shadow: -.3em .3em 0 -.3em #a3afb7, 0 .6em 0 -.3em #a3afb7, .3em .9em 0 -.3em #a3afb7
  }
}

@-o-keyframes loader-cube-grid {
  15% {
    box-shadow: -.3em .3em 0 -.3em #a3afb7, 0 .6em 0 -.3em #a3afb7, .3em .9em 0 -.3em #a3afb7
  }

  30% {
    box-shadow: -.3em .3em 0 0 #a3afb7, 0 .6em 0 0 #a3afb7, .3em .9em 0 0 #a3afb7
  }

  70% {
    box-shadow: -.3em .3em 0 0 #a3afb7, 0 .6em 0 0 #a3afb7, .3em .9em 0 0 #a3afb7
  }

  85% {
    box-shadow: -.3em .3em 0 -.3em #a3afb7, 0 .6em 0 -.3em #a3afb7, .3em .9em 0 -.3em #a3afb7
  }
}

@keyframes loader-cube-grid {
  15% {
    -webkit-box-shadow: -.3em .3em 0 -.3em #a3afb7, 0 .6em 0 -.3em #a3afb7, .3em .9em 0 -.3em #a3afb7;
    box-shadow: -.3em .3em 0 -.3em #a3afb7, 0 .6em 0 -.3em #a3afb7, .3em .9em 0 -.3em #a3afb7
  }

  30% {
    -webkit-box-shadow: -.3em .3em 0 0 #a3afb7, 0 .6em 0 0 #a3afb7, .3em .9em 0 0 #a3afb7;
    box-shadow: -.3em .3em 0 0 #a3afb7, 0 .6em 0 0 #a3afb7, .3em .9em 0 0 #a3afb7
  }

  70% {
    -webkit-box-shadow: -.3em .3em 0 0 #a3afb7, 0 .6em 0 0 #a3afb7, .3em .9em 0 0 #a3afb7;
    box-shadow: -.3em .3em 0 0 #a3afb7, 0 .6em 0 0 #a3afb7, .3em .9em 0 0 #a3afb7
  }

  85% {
    -webkit-box-shadow: -.3em .3em 0 -.3em #a3afb7, 0 .6em 0 -.3em #a3afb7, .3em .9em 0 -.3em #a3afb7;
    box-shadow: -.3em .3em 0 -.3em #a3afb7, 0 .6em 0 -.3em #a3afb7, .3em .9em 0 -.3em #a3afb7
  }
}

@-webkit-keyframes loader-cube-grid-before {
  0% {
    -webkit-box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7;
    box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7
  }

  15% {
    -webkit-box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7;
    box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7
  }

  22.5% {
    -webkit-box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7;
    box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7
  }

  37.5% {
    -webkit-box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7;
    box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7
  }

  55% {
    -webkit-box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7;
    box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7
  }

  70% {
    -webkit-box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7;
    box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7
  }

  77.5% {
    -webkit-box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7;
    box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7
  }

  92.5% {
    -webkit-box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7;
    box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7
  }
}

@-o-keyframes loader-cube-grid-before {
  0% {
    box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7
  }

  15% {
    box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7
  }

  22.5% {
    box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7
  }

  37.5% {
    box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7
  }

  55% {
    box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7
  }

  70% {
    box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7
  }

  77.5% {
    box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7
  }

  92.5% {
    box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7
  }
}

@keyframes loader-cube-grid-before {
  0% {
    -webkit-box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7;
    box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7
  }

  15% {
    -webkit-box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7;
    box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7
  }

  22.5% {
    -webkit-box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7;
    box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7
  }

  37.5% {
    -webkit-box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7;
    box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7
  }

  55% {
    -webkit-box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7;
    box-shadow: -.3em .9em 0 0 #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7
  }

  70% {
    -webkit-box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7;
    box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7
  }

  77.5% {
    -webkit-box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7;
    box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 0 #a3afb7, .3em .6em 0 0 #a3afb7
  }

  92.5% {
    -webkit-box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7;
    box-shadow: -.3em .9em 0 -.3em #a3afb7, 0 .3em 0 -.3em #a3afb7, .3em .6em 0 -.3em #a3afb7
  }
}

@-webkit-keyframes loader-cube-grid-after {
  7.5% {
    -webkit-box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 -.3em #a3afb7;
    box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 -.3em #a3afb7
  }

  22.5% {
    -webkit-box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 -.3em #a3afb7;
    box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 -.3em #a3afb7
  }

  30% {
    -webkit-box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 -.3em #a3afb7;
    box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 -.3em #a3afb7
  }

  45% {
    -webkit-box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 0 #a3afb7;
    box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 0 #a3afb7
  }

  62.5% {
    -webkit-box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 0 #a3afb7;
    box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 0 #a3afb7
  }

  77.5% {
    -webkit-box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 0 #a3afb7;
    box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 0 #a3afb7
  }

  85% {
    -webkit-box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 0 #a3afb7;
    box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 0 #a3afb7
  }

  100% {
    -webkit-box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 -.3em #a3afb7;
    box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 -.3em #a3afb7
  }
}

@-o-keyframes loader-cube-grid-after {
  7.5% {
    box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 -.3em #a3afb7
  }

  22.5% {
    box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 -.3em #a3afb7
  }

  30% {
    box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 -.3em #a3afb7
  }

  45% {
    box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 0 #a3afb7
  }

  62.5% {
    box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 0 #a3afb7
  }

  77.5% {
    box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 0 #a3afb7
  }

  85% {
    box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 0 #a3afb7
  }

  100% {
    box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 -.3em #a3afb7
  }
}

@keyframes loader-cube-grid-after {
  7.5% {
    -webkit-box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 -.3em #a3afb7;
    box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 -.3em #a3afb7
  }

  22.5% {
    -webkit-box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 -.3em #a3afb7;
    box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 -.3em #a3afb7
  }

  30% {
    -webkit-box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 -.3em #a3afb7;
    box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 -.3em #a3afb7
  }

  45% {
    -webkit-box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 0 #a3afb7;
    box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 0 #a3afb7
  }

  62.5% {
    -webkit-box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 0 #a3afb7;
    box-shadow: -.3em .6em 0 0 #a3afb7, 0 .9em 0 0 #a3afb7, .3em .3em 0 0 #a3afb7
  }

  77.5% {
    -webkit-box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 0 #a3afb7;
    box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 0 #a3afb7
  }

  85% {
    -webkit-box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 0 #a3afb7;
    box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 0 #a3afb7
  }

  100% {
    -webkit-box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 -.3em #a3afb7;
    box-shadow: -.3em .6em 0 -.3em #a3afb7, 0 .9em 0 -.3em #a3afb7, .3em .3em 0 -.3em #a3afb7
  }
}

[class*=animation-] {
  -webkit-animation-duration: .5s;
  -o-animation-duration: .5s;
  animation-duration: .5s;
  -webkit-animation-timing-function: ease-out;
  -o-animation-timing-function: ease-out;
  animation-timing-function: ease-out;
  -webkit-animation-fill-mode: both;
  -o-animation-fill-mode: both;
  animation-fill-mode: both
}

.animation-hover:not(:hover),
.animation-hover:not(:hover) [class*=animation-],
.touch .animation-hover:not(.hover),
.touch .animation-hover:not(.hover) [class*=animation-] {
  -webkit-animation-name: none;
  -o-animation-name: none;
  animation-name: none
}

.animation-reverse {
  -webkit-animation-timing-function: ease-in;
  -o-animation-timing-function: ease-in;
  animation-timing-function: ease-in;
  -webkit-animation-direction: reverse;
  -o-animation-direction: reverse;
  animation-direction: reverse
}

.animation-repeat {
  -webkit-animation-iteration-count: infinite;
  -o-animation-iteration-count: infinite;
  animation-iteration-count: infinite
}

.animation-fade {
  -webkit-animation-name: fade;
  -o-animation-name: fade;
  animation-name: fade;
  -webkit-animation-duration: .8s;
  -o-animation-duration: .8s;
  animation-duration: .8s;
  -webkit-animation-timing-function: linear;
  -o-animation-timing-function: linear;
  animation-timing-function: linear
}

.animation-scale {
  -webkit-animation-name: scale-12;
  -o-animation-name: scale-12;
  animation-name: scale-12
}

.animation-scale-up {
  -webkit-animation-name: fade-scale-02;
  -o-animation-name: fade-scale-02;
  animation-name: fade-scale-02
}

.animation-scale-down {
  -webkit-animation-name: fade-scale-18;
  -o-animation-name: fade-scale-18;
  animation-name: fade-scale-18
}

.animation-slide-top {
  -webkit-animation-name: slide-top;
  -o-animation-name: slide-top;
  animation-name: slide-top
}

.animation-slide-bottom {
  -webkit-animation-name: slide-bottom;
  -o-animation-name: slide-bottom;
  animation-name: slide-bottom
}

.animation-slide-left {
  -webkit-animation-name: slide-left;
  -o-animation-name: slide-left;
  animation-name: slide-left
}

.animation-slide-right {
  -webkit-animation-name: slide-right;
  -o-animation-name: slide-right;
  animation-name: slide-right
}

.animation-shake {
  -webkit-animation-name: shake;
  -o-animation-name: shake;
  animation-name: shake
}

.animation-duration-10 {
  -webkit-animation-duration: 15s;
  -o-animation-duration: 15s;
  animation-duration: 15s
}

.animation-duration-9 {
  -webkit-animation-duration: 9s;
  -o-animation-duration: 9s;
  animation-duration: 9s
}

.animation-duration-8 {
  -webkit-animation-duration: 8s;
  -o-animation-duration: 8s;
  animation-duration: 8s
}

.animation-duration-7 {
  -webkit-animation-duration: 7s;
  -o-animation-duration: 7s;
  animation-duration: 7s
}

.animation-duration-6 {
  -webkit-animation-duration: 6s;
  -o-animation-duration: 6s;
  animation-duration: 6s
}

.animation-duration-5 {
  -webkit-animation-duration: 5s;
  -o-animation-duration: 5s;
  animation-duration: 5s
}

.animation-duration-4 {
  -webkit-animation-duration: 4s;
  -o-animation-duration: 4s;
  animation-duration: 4s
}

.animation-duration-3 {
  -webkit-animation-duration: 3s;
  -o-animation-duration: 3s;
  animation-duration: 3s
}

.animation-duration-2 {
  -webkit-animation-duration: 2s;
  -o-animation-duration: 2s;
  animation-duration: 2s
}

.animation-duration-1 {
  -webkit-animation-duration: 1s;
  -o-animation-duration: 1s;
  animation-duration: 1s
}

.animation-delay-100 {
  -webkit-animation-duration: .1s;
  -o-animation-duration: .1s;
  animation-duration: .1s
}

.animation-duration-250 {
  -webkit-animation-duration: 250ms;
  -o-animation-duration: 250ms;
  animation-duration: 250ms
}

.animation-duration-300 {
  -webkit-animation-duration: .3s;
  -o-animation-duration: .3s;
  animation-duration: .3s
}

.animation-duration-500 {
  -webkit-animation-duration: .5s;
  -o-animation-duration: .5s;
  animation-duration: .5s
}

.animation-duration-750 {
  -webkit-animation-duration: 750ms;
  -o-animation-duration: 750ms;
  animation-duration: 750ms
}

.animation-delay-1000 {
  -webkit-animation-delay: 1s;
  -o-animation-delay: 1s;
  animation-delay: 1s
}

.animation-delay-900 {
  -webkit-animation-delay: .9s;
  -o-animation-delay: .9s;
  animation-delay: .9s
}

.animation-delay-800 {
  -webkit-animation-delay: .8s;
  -o-animation-delay: .8s;
  animation-delay: .8s
}

.animation-delay-700 {
  -webkit-animation-delay: .7s;
  -o-animation-delay: .7s;
  animation-delay: .7s
}

.animation-delay-600 {
  -webkit-animation-delay: .6s;
  -o-animation-delay: .6s;
  animation-delay: .6s
}

.animation-delay-500 {
  -webkit-animation-delay: .5s;
  -o-animation-delay: .5s;
  animation-delay: .5s
}

.animation-delay-400 {
  -webkit-animation-delay: .4s;
  -o-animation-delay: .4s;
  animation-delay: .4s
}

.animation-delay-300 {
  -webkit-animation-delay: .3s;
  -o-animation-delay: .3s;
  animation-delay: .3s
}

.animation-delay-200 {
  -webkit-animation-delay: .2s;
  -o-animation-delay: .2s;
  animation-delay: .2s
}

.animation-delay-100 {
  -webkit-animation-delay: .1s;
  -o-animation-delay: .1s;
  animation-delay: .1s
}

.animation-top-left {
  -webkit-transform-origin: 0 0;
  -ms-transform-origin: 0 0;
  -o-transform-origin: 0 0;
  transform-origin: 0 0
}

.animation-top-center {
  -webkit-transform-origin: 50% 0;
  -ms-transform-origin: 50% 0;
  -o-transform-origin: 50% 0;
  transform-origin: 50% 0
}

.animation-top-right {
  -webkit-transform-origin: 100% 0;
  -ms-transform-origin: 100% 0;
  -o-transform-origin: 100% 0;
  transform-origin: 100% 0
}

.animation-middle-left {
  -webkit-transform-origin: 0 50%;
  -ms-transform-origin: 0 50%;
  -o-transform-origin: 0 50%;
  transform-origin: 0 50%
}

.animation-middle-right {
  -webkit-transform-origin: 100% 50%;
  -ms-transform-origin: 100% 50%;
  -o-transform-origin: 100% 50%;
  transform-origin: 100% 50%
}

.animation-bottom-left {
  -webkit-transform-origin: 0 100%;
  -ms-transform-origin: 0 100%;
  -o-transform-origin: 0 100%;
  transform-origin: 0 100%
}

.animation-bottom-center {
  -webkit-transform-origin: 50% 100%;
  -ms-transform-origin: 50% 100%;
  -o-transform-origin: 50% 100%;
  transform-origin: 50% 100%
}

.animation-bottom-right {
  -webkit-transform-origin: 100% 100%;
  -ms-transform-origin: 100% 100%;
  -o-transform-origin: 100% 100%;
  transform-origin: 100% 100%
}

.animation-easing-easeInOut {
  -webkit-animation-timing-function: cubic-bezier(.42, 0, .58, 1);
  -o-animation-timing-function: cubic-bezier(.42, 0, .58, 1);
  animation-timing-function: cubic-bezier(.42, 0, .58, 1)
}

.animation-easing-easeInQuad {
  -webkit-animation-timing-function: cubic-bezier(.55, .085, .68, .53);
  -o-animation-timing-function: cubic-bezier(.55, .085, .68, .53);
  animation-timing-function: cubic-bezier(.55, .085, .68, .53)
}

.animation-easing-easeInCubic {
  -webkit-animation-timing-function: cubic-bezier(.55, .055, .675, .19);
  -o-animation-timing-function: cubic-bezier(.55, .055, .675, .19);
  animation-timing-function: cubic-bezier(.55, .055, .675, .19)
}

.animation-easing-easeInQuart {
  -webkit-animation-timing-function: cubic-bezier(.895, .03, .685, .22);
  -o-animation-timing-function: cubic-bezier(.895, .03, .685, .22);
  animation-timing-function: cubic-bezier(.895, .03, .685, .22)
}

.animation-easing-easeInQuint {
  -webkit-animation-timing-function: cubic-bezier(.755, .05, .855, .06);
  -o-animation-timing-function: cubic-bezier(.755, .05, .855, .06);
  animation-timing-function: cubic-bezier(.755, .05, .855, .06)
}

.animation-easing-easeInSine {
  -webkit-animation-timing-function: cubic-bezier(.47, 0, .745, .715);
  -o-animation-timing-function: cubic-bezier(.47, 0, .745, .715);
  animation-timing-function: cubic-bezier(.47, 0, .745, .715)
}

.animation-easing-easeInExpo {
  -webkit-animation-timing-function: cubic-bezier(.95, .05, .795, .035);
  -o-animation-timing-function: cubic-bezier(.95, .05, .795, .035);
  animation-timing-function: cubic-bezier(.95, .05, .795, .035)
}

.animation-easing-easeInCirc {
  -webkit-animation-timing-function: cubic-bezier(.6, .04, .98, .335);
  -o-animation-timing-function: cubic-bezier(.6, .04, .98, .335);
  animation-timing-function: cubic-bezier(.6, .04, .98, .335)
}

.animation-easing-easeInBack {
  -webkit-animation-timing-function: cubic-bezier(.6, -.28, .735, .045);
  -o-animation-timing-function: cubic-bezier(.6, -.28, .735, .045);
  animation-timing-function: cubic-bezier(.6, -.28, .735, .045)
}

.animation-easing-eastOutQuad {
  -webkit-animation-timing-function: cubic-bezier(.25, .46, .45, .94);
  -o-animation-timing-function: cubic-bezier(.25, .46, .45, .94);
  animation-timing-function: cubic-bezier(.25, .46, .45, .94)
}

.animation-easing-easeOutCubic {
  -webkit-animation-timing-function: cubic-bezier(.215, .61, .355, 1);
  -o-animation-timing-function: cubic-bezier(.215, .61, .355, 1);
  animation-timing-function: cubic-bezier(.215, .61, .355, 1)
}

.animation-easing-easeOutQuart {
  -webkit-animation-timing-function: cubic-bezier(.165, .84, .44, 1);
  -o-animation-timing-function: cubic-bezier(.165, .84, .44, 1);
  animation-timing-function: cubic-bezier(.165, .84, .44, 1)
}

.animation-easing-easeOutQuint {
  -webkit-animation-timing-function: cubic-bezier(.23, 1, .32, 1);
  -o-animation-timing-function: cubic-bezier(.23, 1, .32, 1);
  animation-timing-function: cubic-bezier(.23, 1, .32, 1)
}

.animation-easing-easeOutSine {
  -webkit-animation-timing-function: cubic-bezier(.39, .575, .565, 1);
  -o-animation-timing-function: cubic-bezier(.39, .575, .565, 1);
  animation-timing-function: cubic-bezier(.39, .575, .565, 1)
}

.animation-easing-easeOutExpo {
  -webkit-animation-timing-function: cubic-bezier(.19, 1, .22, 1);
  -o-animation-timing-function: cubic-bezier(.19, 1, .22, 1);
  animation-timing-function: cubic-bezier(.19, 1, .22, 1)
}

.animation-easing-easeOutCirc {
  -webkit-animation-timing-function: cubic-bezier(.075, .82, .165, 1);
  -o-animation-timing-function: cubic-bezier(.075, .82, .165, 1);
  animation-timing-function: cubic-bezier(.075, .82, .165, 1)
}

.animation-easing-easeOutBack {
  -webkit-animation-timing-function: cubic-bezier(.175, .885, .32, 1.275);
  -o-animation-timing-function: cubic-bezier(.175, .885, .32, 1.275);
  animation-timing-function: cubic-bezier(.175, .885, .32, 1.275)
}

.animation-easing-easeInOutQuad {
  -webkit-animation-timing-function: cubic-bezier(.455, .03, .515, .955);
  -o-animation-timing-function: cubic-bezier(.455, .03, .515, .955);
  animation-timing-function: cubic-bezier(.455, .03, .515, .955)
}

.animation-easing-easeInOutCubic {
  -webkit-animation-timing-function: cubic-bezier(.645, .045, .355, 1);
  -o-animation-timing-function: cubic-bezier(.645, .045, .355, 1);
  animation-timing-function: cubic-bezier(.645, .045, .355, 1)
}

.animation-easing-easeInOutQuart {
  -webkit-animation-timing-function: cubic-bezier(.77, 0, .175, 1);
  -o-animation-timing-function: cubic-bezier(.77, 0, .175, 1);
  animation-timing-function: cubic-bezier(.77, 0, .175, 1)
}

.animation-easing-easeInOutQuint {
  -webkit-animation-timing-function: cubic-bezier(.86, 0, .07, 1);
  -o-animation-timing-function: cubic-bezier(.86, 0, .07, 1);
  animation-timing-function: cubic-bezier(.86, 0, .07, 1)
}

.animation-easing-easeInOutSine {
  -webkit-animation-timing-function: cubic-bezier(.445, .05, .55, .95);
  -o-animation-timing-function: cubic-bezier(.445, .05, .55, .95);
  animation-timing-function: cubic-bezier(.445, .05, .55, .95)
}

.animation-easing-easeInOutExpo {
  -webkit-animation-timing-function: cubic-bezier(1, 0, 0, 1);
  -o-animation-timing-function: cubic-bezier(1, 0, 0, 1);
  animation-timing-function: cubic-bezier(1, 0, 0, 1)
}

.animation-easing-easeInOutCirc {
  -webkit-animation-timing-function: cubic-bezier(.785, .135, .15, .86);
  -o-animation-timing-function: cubic-bezier(.785, .135, .15, .86);
  animation-timing-function: cubic-bezier(.785, .135, .15, .86)
}

.animation-easing-easeInOutBack {
  -webkit-animation-timing-function: cubic-bezier(.68, -.55, .265, 1.55);
  -o-animation-timing-function: cubic-bezier(.68, -.55, .265, 1.55);
  animation-timing-function: cubic-bezier(.68, -.55, .265, 1.55)
}

.animation-easing-easeInOutElastic {
  -webkit-animation-timing-function: cubic-bezier(1, -.56, 0, 1.455);
  -o-animation-timing-function: cubic-bezier(1, -.56, 0, 1.455);
  animation-timing-function: cubic-bezier(1, -.56, 0, 1.455)
}

@-webkit-keyframes fade {
  0% {
    opacity: 0
  }

  100% {
    opacity: 1
  }
}

@-o-keyframes fade {
  0% {
    opacity: 0
  }

  100% {
    opacity: 1
  }
}

@keyframes fade {
  0% {
    opacity: 0
  }

  100% {
    opacity: 1
  }
}

@-webkit-keyframes scale-12 {
  0% {
    -webkit-transform: scale(1.2);
    transform: scale(1.2)
  }

  100% {
    -webkit-transform: scale(1);
    transform: scale(1)
  }
}

@-o-keyframes scale-12 {
  0% {
    -o-transform: scale(1.2);
    transform: scale(1.2)
  }

  100% {
    -o-transform: scale(1);
    transform: scale(1)
  }
}

@keyframes scale-12 {
  0% {
    -webkit-transform: scale(1.2);
    -o-transform: scale(1.2);
    transform: scale(1.2)
  }

  100% {
    -webkit-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1)
  }
}

@-webkit-keyframes fade-scale-02 {
  0% {
    opacity: 0;
    -webkit-transform: scale(.2);
    transform: scale(.2)
  }

  100% {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1)
  }
}

@-o-keyframes fade-scale-02 {
  0% {
    opacity: 0;
    -o-transform: scale(.2);
    transform: scale(.2)
  }

  100% {
    opacity: 1;
    -o-transform: scale(1);
    transform: scale(1)
  }
}

@keyframes fade-scale-02 {
  0% {
    opacity: 0;
    -webkit-transform: scale(.2);
    -o-transform: scale(.2);
    transform: scale(.2)
  }

  100% {
    opacity: 1;
    -webkit-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1)
  }
}

@-webkit-keyframes fade-scale-18 {
  0% {
    opacity: 0;
    -webkit-transform: scale(1.8);
    transform: scale(1.8)
  }

  100% {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1)
  }
}

@-o-keyframes fade-scale-18 {
  0% {
    opacity: 0;
    -o-transform: scale(1.8);
    transform: scale(1.8)
  }

  100% {
    opacity: 1;
    -o-transform: scale(1);
    transform: scale(1)
  }
}

@keyframes fade-scale-18 {
  0% {
    opacity: 0;
    -webkit-transform: scale(1.8);
    -o-transform: scale(1.8);
    transform: scale(1.8)
  }

  100% {
    opacity: 1;
    -webkit-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1)
  }
}

@-webkit-keyframes slide-top {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0)
  }

  100% {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0)
  }
}

@-o-keyframes slide-top {
  0% {
    opacity: 0;
    transform: translate3d(0, -100%, 0)
  }

  100% {
    opacity: 1;
    transform: translate3d(0, 0, 0)
  }
}

@keyframes slide-top {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0)
  }

  100% {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0)
  }
}

@-webkit-keyframes slide-bottom {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, 100%, 0);
    transform: translate3d(0, 100%, 0)
  }

  100% {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0)
  }
}

@-o-keyframes slide-bottom {
  0% {
    opacity: 0;
    transform: translate3d(0, 100%, 0)
  }

  100% {
    opacity: 1;
    transform: translate3d(0, 0, 0)
  }
}

@keyframes slide-bottom {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, 100%, 0);
    transform: translate3d(0, 100%, 0)
  }

  100% {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0)
  }
}

@-webkit-keyframes slide-left {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0)
  }

  100% {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0)
  }
}

@-o-keyframes slide-left {
  0% {
    opacity: 0;
    transform: translate3d(-100%, 0, 0)
  }

  100% {
    opacity: 1;
    transform: translate3d(0, 0, 0)
  }
}

@keyframes slide-left {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0)
  }

  100% {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0)
  }
}

@-webkit-keyframes slide-right {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(100%, 0, 0);
    transform: translate3d(100%, 0, 0)
  }

  100% {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0)
  }
}

@-o-keyframes slide-right {
  0% {
    opacity: 0;
    transform: translate3d(100%, 0, 0)
  }

  100% {
    opacity: 1;
    transform: translate3d(0, 0, 0)
  }
}

@keyframes slide-right {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(100%, 0, 0);
    transform: translate3d(100%, 0, 0)
  }

  100% {
    opacity: 1;
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0)
  }
}

@-webkit-keyframes shake {

  0%,
  100% {
    -webkit-transform: translateX(0);
    transform: translateX(0)
  }

  10% {
    -webkit-transform: translateX(-9px);
    transform: translateX(-9px)
  }

  20% {
    -webkit-transform: translateX(8px);
    transform: translateX(8px)
  }

  30% {
    -webkit-transform: translateX(-7px);
    transform: translateX(-7px)
  }

  40% {
    -webkit-transform: translateX(6px);
    transform: translateX(6px)
  }

  50% {
    -webkit-transform: translateX(-5px);
    transform: translateX(-5px)
  }

  60% {
    -webkit-transform: translateX(4px);
    transform: translateX(4px)
  }

  70% {
    -webkit-transform: translateX(-3px);
    transform: translateX(-3px)
  }

  80% {
    -webkit-transform: translateX(2px);
    transform: translateX(2px)
  }

  90% {
    -webkit-transform: translateX(-1px);
    transform: translateX(-1px)
  }
}

@-o-keyframes shake {

  0%,
  100% {
    -o-transform: translateX(0);
    transform: translateX(0)
  }

  10% {
    -o-transform: translateX(-9px);
    transform: translateX(-9px)
  }

  20% {
    -o-transform: translateX(8px);
    transform: translateX(8px)
  }

  30% {
    -o-transform: translateX(-7px);
    transform: translateX(-7px)
  }

  40% {
    -o-transform: translateX(6px);
    transform: translateX(6px)
  }

  50% {
    -o-transform: translateX(-5px);
    transform: translateX(-5px)
  }

  60% {
    -o-transform: translateX(4px);
    transform: translateX(4px)
  }

  70% {
    -o-transform: translateX(-3px);
    transform: translateX(-3px)
  }

  80% {
    -o-transform: translateX(2px);
    transform: translateX(2px)
  }

  90% {
    -o-transform: translateX(-1px);
    transform: translateX(-1px)
  }
}

@keyframes shake {

  0%,
  100% {
    -webkit-transform: translateX(0);
    -o-transform: translateX(0);
    transform: translateX(0)
  }

  10% {
    -webkit-transform: translateX(-9px);
    -o-transform: translateX(-9px);
    transform: translateX(-9px)
  }

  20% {
    -webkit-transform: translateX(8px);
    -o-transform: translateX(8px);
    transform: translateX(8px)
  }

  30% {
    -webkit-transform: translateX(-7px);
    -o-transform: translateX(-7px);
    transform: translateX(-7px)
  }

  40% {
    -webkit-transform: translateX(6px);
    -o-transform: translateX(6px);
    transform: translateX(6px)
  }

  50% {
    -webkit-transform: translateX(-5px);
    -o-transform: translateX(-5px);
    transform: translateX(-5px)
  }

  60% {
    -webkit-transform: translateX(4px);
    -o-transform: translateX(4px);
    transform: translateX(4px)
  }

  70% {
    -webkit-transform: translateX(-3px);
    -o-transform: translateX(-3px);
    transform: translateX(-3px)
  }

  80% {
    -webkit-transform: translateX(2px);
    -o-transform: translateX(2px);
    transform: translateX(2px)
  }

  90% {
    -webkit-transform: translateX(-1px);
    -o-transform: translateX(-1px);
    transform: translateX(-1px)
  }
}

.bg-red-100 {
  background-color: #ffdbdc !important
}

.bg-red-200 {
  background-color: #ffbfc1 !important
}

.bg-red-300 {
  background-color: #ffa1a4 !important
}

.bg-red-400 {
  background-color: #ff8589 !important
}

.bg-red-500 {
  background-color: #ff666b !important
}

.bg-red-600 {
  background-color: #ff4c52 !important
}

.bg-red-700 {
  background-color: #f2353c !important
}

.bg-red-800 {
  background-color: #e62020 !important
}

.bg-red-900 {
  background-color: #d60b0b !important
}

.red-100 {
  color: #ffdbdc !important
}

.red-200 {
  color: #ffbfc1 !important
}

.red-300 {
  color: #ffa1a4 !important
}

.red-400 {
  color: #ff8589 !important
}

.red-500 {
  color: #ff666b !important
}

.red-600 {
  color: #ff4c52 !important
}

.red-700 {
  color: #f2353c !important
}

.red-800 {
  color: #e62020 !important
}

.red-900 {
  color: #d60b0b !important
}

.bg-pink-100 {
  background-color: #ffd9e6 !important
}

.bg-pink-200 {
  background-color: #ffbad2 !important
}

.bg-pink-300 {
  background-color: #ff9ec0 !important
}

.bg-pink-400 {
  background-color: #ff7daa !important
}

.bg-pink-500 {
  background-color: #ff5e97 !important
}

.bg-pink-600 {
  background-color: #f74584 !important
}

.bg-pink-700 {
  background-color: #eb2f71 !important
}

.bg-pink-800 {
  background-color: #e6155e !important
}

.bg-pink-900 {
  background-color: #d10049 !important
}

.pink-100 {
  color: #ffd9e6 !important
}

.pink-200 {
  color: #ffbad2 !important
}

.pink-300 {
  color: #ff9ec0 !important
}

.pink-400 {
  color: #ff7daa !important
}

.pink-500 {
  color: #ff5e97 !important
}

.pink-600 {
  color: #f74584 !important
}

.pink-700 {
  color: #eb2f71 !important
}

.pink-800 {
  color: #e6155e !important
}

.pink-900 {
  color: #d10049 !important
}

.bg-purple-100 {
  background-color: #eae1fc !important
}

.bg-purple-200 {
  background-color: #d9c7fc !important
}

.bg-purple-300 {
  background-color: #c8aefc !important
}

.bg-purple-400 {
  background-color: #b693fa !important
}

.bg-purple-500 {
  background-color: #a57afa !important
}

.bg-purple-600 {
  background-color: #9463f7 !important
}

.bg-purple-700 {
  background-color: #8349f5 !important
}

.bg-purple-800 {
  background-color: #7231f5 !important
}

.bg-purple-900 {
  background-color: #6118f2 !important
}

.purple-100 {
  color: #eae1fc !important
}

.purple-200 {
  color: #d9c7fc !important
}

.purple-300 {
  color: #c8aefc !important
}

.purple-400 {
  color: #b693fa !important
}

.purple-500 {
  color: #a57afa !important
}

.purple-600 {
  color: #9463f7 !important
}

.purple-700 {
  color: #8349f5 !important
}

.purple-800 {
  color: #7231f5 !important
}

.purple-900 {
  color: #6118f2 !important
}

.bg-indigo-100 {
  background-color: #e1e4fc !important
}

.bg-indigo-200 {
  background-color: #c7cffc !important
}

.bg-indigo-300 {
  background-color: #afb9fa !important
}

.bg-indigo-400 {
  background-color: #96a3fa !important
}

.bg-indigo-500 {
  background-color: #7d8efa !important
}

.bg-indigo-600 {
  background-color: #667afa !important
}

.bg-indigo-700 {
  background-color: #4d64fa !important
}

.bg-indigo-800 {
  background-color: #364ff5 !important
}

.bg-indigo-900 {
  background-color: #1f3aed !important
}

.indigo-100 {
  color: #e1e4fc !important
}

.indigo-200 {
  color: #c7cffc !important
}

.indigo-300 {
  color: #afb9fa !important
}

.indigo-400 {
  color: #96a3fa !important
}

.indigo-500 {
  color: #7d8efa !important
}

.indigo-600 {
  color: #667afa !important
}

.indigo-700 {
  color: #4d64fa !important
}

.indigo-800 {
  color: #364ff5 !important
}

.indigo-900 {
  color: #1f3aed !important
}

.bg-blue-100 {
  background-color: #d9e9ff !important
}

.bg-blue-200 {
  background-color: #b8d7ff !important
}

.bg-blue-300 {
  background-color: #99c5ff !important
}

.bg-blue-400 {
  background-color: #79b2fc !important
}

.bg-blue-500 {
  background-color: #589ffc !important
}

.bg-blue-600 {
  background-color: #3e8ef7 !important
}

.bg-blue-700 {
  background-color: #247cf0 !important
}

.bg-blue-800 {
  background-color: #0b69e3 !important
}

.bg-blue-900 {
  background-color: #0053bf !important
}

.blue-100 {
  color: #d9e9ff !important
}

.blue-200 {
  color: #b8d7ff !important
}

.blue-300 {
  color: #99c5ff !important
}

.blue-400 {
  color: #79b2fc !important
}

.blue-500 {
  color: #589ffc !important
}

.blue-600 {
  color: #3e8ef7 !important
}

.blue-700 {
  color: #247cf0 !important
}

.blue-800 {
  color: #0b69e3 !important
}

.blue-900 {
  color: #0053bf !important
}

.bg-cyan-100 {
  background-color: #c2f5ff !important
}

.bg-cyan-200 {
  background-color: #9de6f5 !important
}

.bg-cyan-300 {
  background-color: #77d9ed !important
}

.bg-cyan-400 {
  background-color: #54cbe3 !important
}

.bg-cyan-500 {
  background-color: #28c0de !important
}

.bg-cyan-600 {
  background-color: #0bb2d4 !important
}

.bg-cyan-700 {
  background-color: #0099b8 !important
}

.bg-cyan-800 {
  background-color: #007d96 !important
}

.bg-cyan-900 {
  background-color: #006275 !important
}

.cyan-100 {
  color: #c2f5ff !important
}

.cyan-200 {
  color: #9de6f5 !important
}

.cyan-300 {
  color: #77d9ed !important
}

.cyan-400 {
  color: #54cbe3 !important
}

.cyan-500 {
  color: #28c0de !important
}

.cyan-600 {
  color: #0bb2d4 !important
}

.cyan-700 {
  color: #0099b8 !important
}

.cyan-800 {
  color: #007d96 !important
}

.cyan-900 {
  color: #006275 !important
}

.bg-teal-100 {
  background-color: #c3f7f2 !important
}

.bg-teal-200 {
  background-color: #92f0e6 !important
}

.bg-teal-300 {
  background-color: #6be3d7 !important
}

.bg-teal-400 {
  background-color: #45d6c8 !important
}

.bg-teal-500 {
  background-color: #28c7b7 !important
}

.bg-teal-600 {
  background-color: #17b3a3 !important
}

.bg-teal-700 {
  background-color: #089e8f !important
}

.bg-teal-800 {
  background-color: #008577 !important
}

.bg-teal-900 {
  background-color: #00665c !important
}

.teal-100 {
  color: #c3f7f2 !important
}

.teal-200 {
  color: #92f0e6 !important
}

.teal-300 {
  color: #6be3d7 !important
}

.teal-400 {
  color: #45d6c8 !important
}

.teal-500 {
  color: #28c7b7 !important
}

.teal-600 {
  color: #17b3a3 !important
}

.teal-700 {
  color: #089e8f !important
}

.teal-800 {
  color: #008577 !important
}

.teal-900 {
  color: #00665c !important
}

.bg-green-100 {
  background-color: #c2fadc !important
}

.bg-green-200 {
  background-color: #99f2c2 !important
}

.bg-green-300 {
  background-color: #72e8ab !important
}

.bg-green-400 {
  background-color: #49de94 !important
}

.bg-green-500 {
  background-color: #28d17c !important
}

.bg-green-600 {
  background-color: #11c26d !important
}

.bg-green-700 {
  background-color: #05a85c !important
}

.bg-green-800 {
  background-color: #008c4d !important
}

.bg-green-900 {
  background-color: #006e3c !important
}

.green-100 {
  color: #c2fadc !important
}

.green-200 {
  color: #99f2c2 !important
}

.green-300 {
  color: #72e8ab !important
}

.green-400 {
  color: #49de94 !important
}

.green-500 {
  color: #28d17c !important
}

.green-600 {
  color: #11c26d !important
}

.green-700 {
  color: #05a85c !important
}

.green-800 {
  color: #008c4d !important
}

.green-900 {
  color: #006e3c !important
}

.bg-light-green-100 {
  background-color: #dcf7b0 !important
}

.bg-light-green-200 {
  background-color: #c3e887 !important
}

.bg-light-green-300 {
  background-color: #add966 !important
}

.bg-light-green-400 {
  background-color: #94cc39 !important
}

.bg-light-green-500 {
  background-color: #7eb524 !important
}

.bg-light-green-600 {
  background-color: #6da611 !important
}

.bg-light-green-700 {
  background-color: #5a9101 !important
}

.bg-light-green-800 {
  background-color: #4a7800 !important
}

.bg-light-green-900 {
  background-color: #3a5e00 !important
}

.light-green-100 {
  color: #dcf7b0 !important
}

.light-green-200 {
  color: #c3e887 !important
}

.light-green-300 {
  color: #add966 !important
}

.light-green-400 {
  color: #94cc39 !important
}

.light-green-500 {
  color: #7eb524 !important
}

.light-green-600 {
  color: #6da611 !important
}

.light-green-700 {
  color: #5a9101 !important
}

.light-green-800 {
  color: #4a7800 !important
}

.light-green-900 {
  color: #3a5e00 !important
}

.bg-yellow-100 {
  background-color: #fff6b5 !important
}

.bg-yellow-200 {
  background-color: #fff39c !important
}

.bg-yellow-300 {
  background-color: #ffed78 !important
}

.bg-yellow-400 {
  background-color: #ffe54f !important
}

.bg-yellow-500 {
  background-color: #ffdc2e !important
}

.bg-yellow-600 {
  background-color: #ffcd17 !important
}

.bg-yellow-700 {
  background-color: #fcb900 !important
}

.bg-yellow-800 {
  background-color: #faa700 !important
}

.bg-yellow-900 {
  background-color: #fa9600 !important
}

.yellow-100 {
  color: #fff6b5 !important
}

.yellow-200 {
  color: #fff39c !important
}

.yellow-300 {
  color: #ffed78 !important
}

.yellow-400 {
  color: #ffe54f !important
}

.yellow-500 {
  color: #ffdc2e !important
}

.yellow-600 {
  color: #ffcd17 !important
}

.yellow-700 {
  color: #fcb900 !important
}

.yellow-800 {
  color: #faa700 !important
}

.yellow-900 {
  color: #fa9600 !important
}

.bg-orange-100 {
  background-color: #ffe1c4 !important
}

.bg-orange-200 {
  background-color: #ffc894 !important
}

.bg-orange-300 {
  background-color: #fab06b !important
}

.bg-orange-400 {
  background-color: #fa983c !important
}

.bg-orange-500 {
  background-color: #f57d1b !important
}

.bg-orange-600 {
  background-color: #eb6709 !important
}

.bg-orange-700 {
  background-color: #de4e00 !important
}

.bg-orange-800 {
  background-color: #b53f00 !important
}

.bg-orange-900 {
  background-color: #962d00 !important
}

.orange-100 {
  color: #ffe1c4 !important
}

.orange-200 {
  color: #ffc894 !important
}

.orange-300 {
  color: #fab06b !important
}

.orange-400 {
  color: #fa983c !important
}

.orange-500 {
  color: #f57d1b !important
}

.orange-600 {
  color: #eb6709 !important
}

.orange-700 {
  color: #de4e00 !important
}

.orange-800 {
  color: #b53f00 !important
}

.orange-900 {
  color: #962d00 !important
}

.bg-brown-100 {
  background-color: #f5e2da !important
}

.bg-brown-200 {
  background-color: #e0cdc5 !important
}

.bg-brown-300 {
  background-color: #cfb8b0 !important
}

.bg-brown-400 {
  background-color: #bda299 !important
}

.bg-brown-500 {
  background-color: #ab8c82 !important
}

.bg-brown-600 {
  background-color: #997b71 !important
}

.bg-brown-700 {
  background-color: #82675f !important
}

.bg-brown-800 {
  background-color: #6b534c !important
}

.bg-brown-900 {
  background-color: #57403a !important
}

.brown-100 {
  color: #f5e2da !important
}

.brown-200 {
  color: #e0cdc5 !important
}

.brown-300 {
  color: #cfb8b0 !important
}

.brown-400 {
  color: #bda299 !important
}

.brown-500 {
  color: #ab8c82 !important
}

.brown-600 {
  color: #997b71 !important
}

.brown-700 {
  color: #82675f !important
}

.brown-800 {
  color: #6b534c !important
}

.brown-900 {
  color: #57403a !important
}

.bg-grey-100 {
  background-color: #fafafa !important
}

.bg-grey-200 {
  background-color: #eee !important
}

.bg-grey-300 {
  background-color: #e0e0e0 !important
}

.bg-grey-400 {
  background-color: #bdbdbd !important
}

.bg-grey-500 {
  background-color: #9e9e9e !important
}

.bg-grey-600 {
  background-color: #757575 !important
}

.bg-grey-700 {
  background-color: #616161 !important
}

.bg-grey-800 {
  background-color: #424242 !important
}

.bg-grey-900 {
  background-color: #474747 !important
}

.grey-100 {
  color: #fafafa !important
}

.grey-200 {
  color: #eee !important
}

.grey-300 {
  color: #e0e0e0 !important
}

.grey-400 {
  color: #bdbdbd !important
}

.grey-500 {
  color: #9e9e9e !important
}

.grey-600 {
  color: #757575 !important
}

.grey-700 {
  color: #616161 !important
}

.grey-800 {
  color: #424242 !important
}

.grey-900 {
  color: #474747 !important
}

.bg-blue-grey-100 {
  background-color: #f3f7f9 !important
}

.bg-blue-grey-200 {
  background-color: #e4eaec !important
}

.bg-blue-grey-300 {
  background-color: #ccd5db !important
}

.bg-blue-grey-400 {
  background-color: #a3afb7 !important
}

.bg-blue-grey-500 {
  background-color: #76838f !important
}

.bg-blue-grey-600 {
  background-color: #526069 !important
}

.bg-blue-grey-700 {
  background-color: #37474f !important
}

.bg-blue-grey-800 {
  background-color: #263238 !important
}

.bg-blue-grey-900 {
  background-color: #3e4854 !important
}

.blue-grey-100 {
  color: #f3f7f9 !important
}

.blue-grey-200 {
  color: #e4eaec !important
}

.blue-grey-300 {
  color: #ccd5db !important
}

.blue-grey-400 {
  color: #a3afb7 !important
}

.blue-grey-500 {
  color: #76838f !important
}

.blue-grey-600 {
  color: #526069 !important
}

.blue-grey-700 {
  color: #37474f !important
}

.blue-grey-800 {
  color: #263238 !important
}

.blue-grey-900 {
  color: #3e4854 !important
}

.bg-primary-100 {
  background-color: #d9e9ff !important
}

.bg-primary-200 {
  background-color: #b8d7ff !important
}

.bg-primary-300 {
  background-color: #99c5ff !important
}

.bg-primary-400 {
  background-color: #79b2fc !important
}

.bg-primary-500 {
  background-color: #589ffc !important
}

.bg-primary-600 {
  background-color: #3e8ef7 !important
}

.bg-primary-700 {
  background-color: #247cf0 !important
}

.bg-primary-800 {
  background-color: #0b69e3 !important
}

.primary-100 {
  color: #d9e9ff !important
}

.primary-200 {
  color: #b8d7ff !important
}

.primary-300 {
  color: #99c5ff !important
}

.primary-400 {
  color: #79b2fc !important
}

.primary-500 {
  color: #589ffc !important
}

.primary-600 {
  color: #3e8ef7 !important
}

.primary-700 {
  color: #247cf0 !important
}

.primary-800 {
  color: #0b69e3 !important
}

.black {
  color: #000 !important
}

.white {
  color: #fff !important
}

.bg-white {
  color: #76838f;
  background-color: #fff
}

.bg-primary {
  color: #fff;
  background-color: #3e8ef7
}

.bg-primary:hover {
  background-color: #6fabf9
}

.bg-primary a,
.bg-primary a.bg-primary {
  color: #fff
}

.bg-primary a.bg-primary:hover,
.bg-primary a:hover {
  color: #fff
}

.bg-success {
  color: #fff;
  background-color: #11c26d
}

.bg-success:hover {
  background-color: #1beb87
}

.bg-success a,
.bg-success a.bg-primary {
  color: #fff
}

.bg-success a.bg-primary:hover,
.bg-success a:hover {
  color: #fff
}

.bg-info {
  color: #fff;
  background-color: #0bb2d4
}

.bg-info:hover {
  background-color: #1fcff3
}

.bg-info a,
.bg-info a.bg-info {
  color: #fff
}

.bg-info a.bg-info:hover,
.bg-info a:hover {
  color: #fff
}

.bg-warning {
  color: #fff;
  background-color: #eb6709
}

.bg-warning:hover {
  background-color: #f78330
}

.bg-warning a,
.bg-warning a.bg-warning {
  color: #fff
}

.bg-warning a.bg-warning:hover,
.bg-warning a:hover {
  color: #fff
}

.bg-danger {
  color: #fff;
  background-color: #ff4c52
}

.bg-danger:hover {
  background-color: #ff7f83
}

.bg-danger a,
.bg-danger a.bg-danger {
  color: #fff
}

.bg-danger a.bg-danger:hover,
.bg-danger a:hover {
  color: #fff
}

.bg-dark {
  color: #fff;
  background-color: #526069
}

.bg-dark:hover {
  background-color: #687a86
}

.bg-dark a,
.bg-dark a.bg-dark {
  color: #fff
}

.bg-dark a.bg-dark:hover,
.bg-dark a:hover {
  color: #fff
}

.social-facebook {
  color: #fff;
  background-color: #3b5998 !important
}

.social-facebook:focus,
.social-facebook:hover {
  color: #fff;
  background-color: #4c70ba !important
}

.social-facebook.active,
.social-facebook:active {
  color: #fff;
  background-color: #2d4373 !important
}

.bg-facebook {
  background-color: #3b5998
}

.social-twitter {
  color: #fff;
  background-color: #55acee !important
}

.social-twitter:focus,
.social-twitter:hover {
  color: #fff;
  background-color: #83c3f3 !important
}

.social-twitter.active,
.social-twitter:active {
  color: #fff;
  background-color: #2795e9 !important
}

.bg-twitter {
  background-color: #55acee
}

.social-google-plus {
  color: #fff;
  background-color: #dd4b39 !important
}

.social-google-plus:focus,
.social-google-plus:hover {
  color: #fff;
  background-color: #e47365 !important
}

.social-google-plus.active,
.social-google-plus:active {
  color: #fff;
  background-color: #c23321 !important
}

.bg-google-plus {
  background-color: #dd4b39
}

.social-linkedin {
  color: #fff;
  background-color: #0976b4 !important
}

.social-linkedin:focus,
.social-linkedin:hover {
  color: #fff;
  background-color: #0b96e5 !important
}

.social-linkedin.active,
.social-linkedin:active {
  color: #fff;
  background-color: #075683 !important
}

.bg-linkedin {
  background-color: #0976b4
}

.social-flickr {
  color: #fff;
  background-color: #ff0084 !important
}

.social-flickr:focus,
.social-flickr:hover {
  color: #fff;
  background-color: #ff339d !important
}

.social-flickr.active,
.social-flickr:active {
  color: #fff;
  background-color: #cc006a !important
}

.bg-flickr {
  background-color: #ff0084
}

.social-tumblr {
  color: #fff;
  background-color: #35465c !important
}

.social-tumblr:focus,
.social-tumblr:hover {
  color: #fff;
  background-color: #485f7c !important
}

.social-tumblr.active,
.social-tumblr:active {
  color: #fff;
  background-color: #222d3c !important
}

.bg-tumblr {
  background-color: #35465c
}

.social-xing {
  color: #fff;
  background-color: #024b4d !important
}

.social-xing:focus,
.social-xing:hover {
  color: #fff;
  background-color: #037b7f !important
}

.social-xing.active,
.social-xing:active {
  color: #fff;
  background-color: #011b1b !important
}

.bg-xing {
  background-color: #024b4d
}

.social-github {
  color: #fff;
  background-color: #4183c4 !important
}

.social-github:focus,
.social-github:hover {
  color: #fff;
  background-color: #689cd0 !important
}

.social-github.active,
.social-github:active {
  color: #fff;
  background-color: #3269a0 !important
}

.bg-github {
  background-color: #4183c4
}

.social-html5 {
  color: #fff;
  background-color: #e44f26 !important
}

.social-html5:focus,
.social-html5:hover {
  color: #fff;
  background-color: #ea7453 !important
}

.social-html5.active,
.social-html5:active {
  color: #fff;
  background-color: #bf3c18 !important
}

.bg-html5 {
  background-color: #e44f26
}

.social-openid {
  color: #fff;
  background-color: #f67d28 !important
}

.social-openid:focus,
.social-openid:hover {
  color: #fff;
  background-color: #f89b59 !important
}

.social-openid.active,
.social-openid:active {
  color: #fff;
  background-color: #e26309 !important
}

.bg-openid {
  background-color: #f67d28
}

.social-stack-overflow {
  color: #fff;
  background-color: #f86c01 !important
}

.social-stack-overflow:focus,
.social-stack-overflow:hover {
  color: #fff;
  background-color: #fe882e !important
}

.social-stack-overflow.active,
.social-stack-overflow:active {
  color: #fff;
  background-color: #c55601 !important
}

.bg-stack-overflow {
  background-color: #f86c01
}

.social-css3 {
  color: #fff;
  background-color: #1572b6 !important
}

.social-css3:focus,
.social-css3:hover {
  color: #fff;
  background-color: #1a8fe4 !important
}

.social-css3.active,
.social-css3:active {
  color: #fff;
  background-color: #105588 !important
}

.bg-css3 {
  background-color: #1572b6
}

.social-youtube {
  color: #fff;
  background-color: #b31217 !important
}

.social-youtube:focus,
.social-youtube:hover {
  color: #fff;
  background-color: #e1171d !important
}

.social-youtube.active,
.social-youtube:active {
  color: #fff;
  background-color: #850d11 !important
}

.bg-youtube {
  background-color: #b31217
}

.social-dribbble {
  color: #fff;
  background-color: #c32361 !important
}

.social-dribbble:focus,
.social-dribbble:hover {
  color: #fff;
  background-color: #dc3d7b !important
}

.social-dribbble.active,
.social-dribbble:active {
  color: #fff;
  background-color: #981b4b !important
}

.bg-dribbble {
  background-color: #c32361
}

.social-instagram {
  color: #fff;
  background-color: #3f729b !important
}

.social-instagram:focus,
.social-instagram:hover {
  color: #fff;
  background-color: #548cb9 !important
}

.social-instagram.active,
.social-instagram:active {
  color: #fff;
  background-color: #305777 !important
}

.bg-instagram {
  background-color: #3f729b
}

.social-pinterest {
  color: #fff;
  background-color: #cc2127 !important
}

.social-pinterest:focus,
.social-pinterest:hover {
  color: #fff;
  background-color: #e04046 !important
}

.social-pinterest.active,
.social-pinterest:active {
  color: #fff;
  background-color: #a01a1f !important
}

.bg-pinterest {
  background-color: #cc2127
}

.social-vk {
  color: #fff;
  background-color: #3d5a7d !important
}

.social-vk:focus,
.social-vk:hover {
  color: #fff;
  background-color: #4e739f !important
}

.social-vk.active,
.social-vk:active {
  color: #fff;
  background-color: #2c415b !important
}

.bg-vk {
  background-color: #3d5a7d
}

.social-yahoo {
  color: #fff;
  background-color: #350178 !important
}

.social-yahoo:focus,
.social-yahoo:hover {
  color: #fff;
  background-color: #4b01ab !important
}

.social-yahoo.active,
.social-yahoo:active {
  color: #fff;
  background-color: #1f0145 !important
}

.bg-yahoo {
  background-color: #350178
}

.social-behance {
  color: #fff;
  background-color: #1769ff !important
}

.social-behance:focus,
.social-behance:hover {
  color: #fff;
  background-color: #4a8aff !important
}

.social-behance.active,
.social-behance:active {
  color: #fff;
  background-color: #0050e3 !important
}

.bg-behance {
  background-color: #024b4d
}

.social-dropbox {
  color: #fff;
  background-color: #007ee5 !important
}

.social-dropbox:focus,
.social-dropbox:hover {
  color: #fff;
  background-color: #1998ff !important
}

.social-dropbox.active,
.social-dropbox:active {
  color: #fff;
  background-color: #0062b2 !important
}

.bg-dropbox {
  background-color: #007ee5
}

.social-reddit {
  color: #fff;
  background-color: #ff4500 !important
}

.social-reddit:focus,
.social-reddit:hover {
  color: #fff;
  background-color: #ff6a33 !important
}

.social-reddit.active,
.social-reddit:active {
  color: #fff;
  background-color: #cc3700 !important
}

.bg-reddit {
  background-color: #ff4500
}

.social-spotify {
  color: #fff;
  background-color: #7ab800 !important
}

.social-spotify:focus,
.social-spotify:hover {
  color: #fff;
  background-color: #9ceb00 !important
}

.social-spotify.active,
.social-spotify:active {
  color: #fff;
  background-color: #588500 !important
}

.bg-spotify {
  background-color: #7ab800
}

.social-vine {
  color: #fff;
  background-color: #00b488 !important
}

.social-vine:focus,
.social-vine:hover {
  color: #fff;
  background-color: #00e7af !important
}

.social-vine.active,
.social-vine:active {
  color: #fff;
  background-color: #008161 !important
}

.bg-vine {
  background-color: #00b488
}

.social-foursquare {
  color: #fff;
  background-color: #0cbadf !important
}

.social-foursquare:focus,
.social-foursquare:hover {
  color: #fff;
  background-color: #2ad0f4 !important
}

.social-foursquare.active,
.social-foursquare:active {
  color: #fff;
  background-color: #0992af !important
}

.bg-foursquare {
  background-color: #0cbadf
}

.social-vimeo {
  color: #fff;
  background-color: #1ab7ea !important
}

.social-vimeo:focus,
.social-vimeo:hover {
  color: #fff;
  background-color: #49c6ee !important
}

.social-vimeo.active,
.social-vimeo:active {
  color: #fff;
  background-color: #1295bf !important
}

.bg-vimeo {
  background-color: #1ab7ea
}

.social-skype {
  color: #fff;
  background-color: #77bcfd !important
}

.social-skype:focus,
.social-skype:hover {
  color: #fff;
  background-color: #a9d5fe !important
}

.social-skype.active,
.social-skype:active {
  color: #fff;
  background-color: #45a3fc !important
}

.bg-skype {
  background-color: #77bcfd
}

.social-evernote {
  color: #fff;
  background-color: #46bf8c !important
}

.social-evernote:focus,
.social-evernote:hover {
  color: #fff;
  background-color: #6ccca4 !important
}

.social-evernote.active,
.social-evernote:active {
  color: #fff;
  background-color: #369c71 !important
}

.bg-evernote {
  background-color: #46bf8c
}

.blocks,
[class*=blocks-] {
  font-size: 0;
  padding: 0;
  margin: 0;
  margin-right: -1.0715rem;
  margin-left: -1.0715rem;
  list-style: none
}

.blocks>.block,
[class*=blocks-]>.block,
[class*=blocks-]>li {
  display: inline-block;
  font-size: 1rem;
  vertical-align: top;
  padding-right: 1.0715rem;
  padding-left: 1.0715rem;
  margin-bottom: 2.143rem
}

.blocks.no-space,
[class*=blocks-].no-space {
  margin: 0
}

.blocks.no-space>.block,
.blocks.no-space>li,
[class*=blocks-].no-space>.block,
[class*=blocks-].no-space>li {
  padding: 0;
  margin: 0
}

.blocks-100>.block,
.blocks-100>li {
  width: 100%
}

.blocks-2>.block,
.blocks-2>li {
  width: 50%
}

.blocks-3>.block,
.blocks-3>li {
  width: 33.333333%
}

.blocks-4>.block,
.blocks-4>li {
  width: 25%
}

.blocks-5>.block,
.blocks-5>li {
  width: 20%
}

.blocks-6>.block,
.blocks-6>li {
  width: 16.666667%
}

.blocks-xs-100>.block,
.blocks-xs-100>li {
  width: 100%
}

.blocks-xs-2>.block,
.blocks-xs-2>li {
  width: 50%
}

.blocks-xs-3>.block,
.blocks-xs-3>li {
  width: 33.333333%
}

.blocks-xs-4>.block,
.blocks-xs-4>li {
  width: 25%
}

.blocks-xs-5>.block,
.blocks-xs-5>li {
  width: 20%
}

.blocks-xs-6>.block,
.blocks-xs-6>li {
  width: 16.666667%
}

@media (min-width:480px) {

  .blocks-sm-100>.block,
  .blocks-sm-100>li {
    width: 100%
  }

  .blocks-sm-2>.block,
  .blocks-sm-2>li {
    width: 50%
  }

  .blocks-sm-3>.block,
  .blocks-sm-3>li {
    width: 33.333333%
  }

  .blocks-sm-4>.block,
  .blocks-sm-4>li {
    width: 25%
  }

  .blocks-sm-5>.block,
  .blocks-sm-5>li {
    width: 20%
  }

  .blocks-sm-6>.block,
  .blocks-sm-6>li {
    width: 16.666667%
  }
}

@media (min-width:768px) {

  .blocks-md-100>.block,
  .blocks-md-100>li {
    width: 100%
  }

  .blocks-md-2>.block,
  .blocks-md-2>li {
    width: 50%
  }

  .blocks-md-3>.block,
  .blocks-md-3>li {
    width: 33.333333%
  }

  .blocks-md-4>.block,
  .blocks-md-4>li {
    width: 25%
  }

  .blocks-md-5>.block,
  .blocks-md-5>li {
    width: 20%
  }

  .blocks-md-6>.block,
  .blocks-md-6>li {
    width: 16.666667%
  }
}

@media (min-width:992px) {

  .blocks-lg-100>.block,
  .blocks-lg-100>li {
    width: 100%
  }

  .blocks-lg-2>.block,
  .blocks-lg-2>li {
    width: 50%
  }

  .blocks-lg-3>.block,
  .blocks-lg-3>li {
    width: 33.333333%
  }

  .blocks-lg-4>.block,
  .blocks-lg-4>li {
    width: 25%
  }

  .blocks-lg-5>.block,
  .blocks-lg-5>li {
    width: 20%
  }

  .blocks-lg-6>.block,
  .blocks-lg-6>li {
    width: 16.666667%
  }
}

@media (min-width:1200px) {

  .blocks-xl-100>.block,
  .blocks-xl-100>li {
    width: 100%
  }

  .blocks-xl-2>.block,
  .blocks-xl-2>li {
    width: 50%
  }

  .blocks-xl-3>.block,
  .blocks-xl-3>li {
    width: 33.333333%
  }

  .blocks-xl-4>.block,
  .blocks-xl-4>li {
    width: 25%
  }

  .blocks-xl-5>.block,
  .blocks-xl-5>li {
    width: 20%
  }

  .blocks-xl-6>.block,
  .blocks-xl-6>li {
    width: 16.666667%
  }
}

@media (min-width:1600px) {

  .blocks-xxl-100>.block,
  .blocks-xxl-100>li {
    width: 100%
  }

  .blocks-xxl-2>.block,
  .blocks-xxl-2>li {
    width: 50%
  }

  .blocks-xxl-3>.block,
  .blocks-xxl-3>li {
    width: 33.333333%
  }

  .blocks-xxl-4>.block,
  .blocks-xxl-4>li {
    width: 25%
  }

  .blocks-xxl-5>.block,
  .blocks-xxl-5>li {
    width: 20%
  }

  .blocks-xxl-6>.block,
  .blocks-xxl-6>li {
    width: 16.666667%
  }
}

.avatar {
  position: relative;
  display: inline-block;
  width: 40px;
  white-space: nowrap;
  vertical-align: bottom;
  border-radius: 1000px
}

.avatar i {
  position: absolute;
  right: 0;
  bottom: 0;
  width: 10px;
  height: 10px;
  border: 2px solid #fff;
  border-radius: 100%
}

.avatar img {
  width: 100%;
  max-width: 100%;
  height: auto;
  border: 0 none;
  border-radius: 1000px
}

.avatar-online i {
  background-color: #11c26d
}

.avatar-off i {
  background-color: #526069
}

.avatar-busy i {
  background-color: #eb6709
}

.avatar-away i {
  background-color: #ff4c52
}

.avatar-100 {
  width: 100px
}

.avatar-100 i {
  width: 20px;
  height: 20px
}

.avatar-lg {
  width: 50px
}

.avatar-lg i {
  width: 12px;
  height: 12px
}

.avatar-sm {
  width: 30px
}

.avatar-sm i {
  width: 8px;
  height: 8px
}

.avatar-xs {
  width: 20px
}

.avatar-xs i {
  width: 7px;
  height: 7px
}

.status {
  display: block;
  width: 10px;
  height: 10px;
  border: 2px solid #fff;
  border-radius: 100%
}

.status-online {
  background-color: #11c26d
}

.status-off {
  background-color: #526069
}

.status-busy {
  background-color: #eb6709
}

.status-away {
  background-color: #ff4c52
}

.status-lg {
  width: 14px;
  height: 14px
}

.status-md {
  width: 10px;
  height: 10px
}

.status-sm {
  width: 8px;
  height: 8px
}

.status-xs {
  width: 7px;
  height: 7px
}

.icon {
  position: relative;
  display: inline-block;
  font-style: normal;
  font-weight: 400;
  -webkit-transform: translate(0, 0);
  -ms-transform: translate(0, 0);
  -o-transform: translate(0, 0);
  transform: translate(0, 0);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  speak: none;
  text-rendering: auto;
  line-height: 1
}

.icon.float-left {
  margin-right: .3em
}

.icon.float-right {
  margin-left: .3em
}

.icon-circle {
  position: relative;
  margin: .5em
}

.icon-circle:before {
  position: relative;
  z-index: 1
}

.icon-circle:after {
  position: absolute;
  top: 50%;
  left: 50%;
  z-index: 0;
  width: 2em;
  height: 2em;
  content: "";
  background-color: inherit;
  border-radius: 100%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  -o-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%)
}

.icon-lg {
  font-size: 1.333333em;
  vertical-align: -15%
}

.icon-2x {
  font-size: 2em
}

.icon-3x {
  font-size: 3em
}

.icon-4x {
  font-size: 4em
}

.icon-5x {
  font-size: 5em
}

.icon-fw {
  width: 1.285714em;
  text-align: center
}

.icon-ul {
  padding-left: 0;
  margin-left: 2.142857em;
  list-style-type: none
}

.icon-ul>li {
  position: relative
}

.icon-li {
  position: absolute;
  top: .142857em;
  left: -2.142857em;
  width: 2.142857em;
  text-align: center
}

.icon-li.icon-lg {
  left: -1.857143em
}

.icon-border {
  padding: .2em .25em .15em;
  border: solid .08em #e4eaec;
  border-radius: .1em
}

.icon-spin {
  -webkit-animation: icon-spin 2s infinite linear;
  -o-animation: icon-spin 2s infinite linear;
  animation: icon-spin 2s infinite linear
}

.icon-spin-reverse {
  -webkit-animation: icon-spin-reverse 2s infinite linear;
  -o-animation: icon-spin-reverse 2s infinite linear;
  animation: icon-spin-reverse 2s infinite linear
}

.icon-rotate-90 {
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=$rotation);
  -webkit-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  transform: rotate(90deg)
}

.icon-rotate-180 {
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=$rotation);
  -webkit-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg)
}

.icon-rotate-270 {
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=$rotation);
  -webkit-transform: rotate(270deg);
  -ms-transform: rotate(270deg);
  -o-transform: rotate(270deg);
  transform: rotate(270deg)
}

.icon-flip-horizontal {
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=$rotation, mirror=1);
  -webkit-transform: scale(-1, 1);
  -ms-transform: scale(-1, 1);
  -o-transform: scale(-1, 1);
  transform: scale(-1, 1)
}

.icon-flip-vertical {
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=$rotation, mirror=1);
  -webkit-transform: scale(1, -1);
  -ms-transform: scale(1, -1);
  -o-transform: scale(1, -1);
  transform: scale(1, -1)
}

.icon-stack {
  position: relative;
  display: inline-block;
  width: 2em;
  height: 2em;
  line-height: 2em;
  vertical-align: middle
}

.icon-stack-1x,
.icon-stack-2x {
  position: absolute;
  left: 0;
  width: 100%;
  text-align: center
}

.icon-stack-1x {
  line-height: inherit
}

.icon-stack-2x {
  font-size: 2em
}

.icon-stack-inverse {
  color: #fff
}

.icon-color {
  color: rgba(55, 71, 79, .4)
}

.icon-color:focus,
.icon-color:hover {
  color: rgba(55, 71, 79, .6)
}

.icon-color.active,
.icon-color:active {
  color: #37474f
}

.icon-color-alt {
  color: rgba(55, 71, 79, .6)
}

.icon-color-alt:focus,
.icon-color-alt:hover {
  color: rgba(55, 71, 79, .8)
}

.icon-color-alt.active,
.icon-color-alt:active {
  color: #37474f
}

:root-flip-horizontal,
:root-flip-vertical,
:root-rotate-180,
:root-rotate-270,
:root-rotate-90 {
  -webkit-filter: none;
  filter: none
}

@-webkit-keyframes icon-spin {
  0% {
    -webkit-transform: rotate(0);
    transform: rotate(0)
  }

  100% {
    -webkit-transform: rotate(359deg);
    transform: rotate(359deg)
  }
}

@-o-keyframes icon-spin {
  0% {
    -o-transform: rotate(0);
    transform: rotate(0)
  }

  100% {
    -o-transform: rotate(359deg);
    transform: rotate(359deg)
  }
}

@keyframes icon-spin {
  0% {
    -webkit-transform: rotate(0);
    -o-transform: rotate(0);
    transform: rotate(0)
  }

  100% {
    -webkit-transform: rotate(359deg);
    -o-transform: rotate(359deg);
    transform: rotate(359deg)
  }
}

@-webkit-keyframes icon-spin-reverse {
  0% {
    -webkit-transform: rotate(0);
    transform: rotate(0)
  }

  100% {
    -webkit-transform: rotate(-359deg);
    transform: rotate(-359deg)
  }
}

@-o-keyframes icon-spin-reverse {
  0% {
    -o-transform: rotate(0);
    transform: rotate(0)
  }

  100% {
    -o-transform: rotate(-359deg);
    transform: rotate(-359deg)
  }
}

@keyframes icon-spin-reverse {
  0% {
    -webkit-transform: rotate(0);
    -o-transform: rotate(0);
    transform: rotate(0)
  }

  100% {
    -webkit-transform: rotate(-359deg);
    -o-transform: rotate(-359deg);
    transform: rotate(-359deg)
  }
}

.hamburger {
  font-size: 17px;
  vertical-align: middle
}

.hamburger,
.hamburger .hamburger-bar,
.hamburger:after,
.hamburger:before {
  -webkit-transition: -webkit-transform .2s ease-in-out;
  -o-transition: -o-transform .2s ease-in-out;
  transition: transform .2s ease-in-out
}

.hamburger:after,
.hamburger:before {
  content: ""
}

.hamburger .hamburger-bar,
.hamburger:after,
.hamburger:before {
  display: block;
  width: 1em;
  height: .1em;
  margin: 0;
  background: #ffffff;
  border-radius: 1px
}

.navbar-default .hamburger .hamburger-bar,
.navbar-default .hamburger:after,
.navbar-default .hamburger:before {
  background: #ffffff
}

.navbar-inverse .hamburger .hamburger-bar,
.navbar-inverse .hamburger:after,
.navbar-inverse .hamburger:before {
  background: #fff
}

.hamburger .hamburger-bar {
  margin: .2em 0
}

.hamburger-close:before {
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg);
  -webkit-transform-origin: 8%;
  -ms-transform-origin: 8%;
  -o-transform-origin: 8%;
  transform-origin: 8%
}

.hamburger-close .hamburger-bar {
  opacity: 0
}

.hamburger-close:after {
  -webkit-transform: rotate(-45deg);
  -ms-transform: rotate(-45deg);
  -o-transform: rotate(-45deg);
  transform: rotate(-45deg);
  -webkit-transform-origin: 8%;
  -ms-transform-origin: 8%;
  -o-transform-origin: 8%;
  transform-origin: 8%
}

.hamburger-close.collapsed:before,
.hamburger-close.hided:before {
  -webkit-transform: rotate(0);
  -ms-transform: rotate(0);
  -o-transform: rotate(0);
  transform: rotate(0)
}

.hamburger-close.collapsed .hamburger-bar,
.hamburger-close.hided .hamburger-bar {
  opacity: 1
}

.hamburger-close.collapsed:after,
.hamburger-close.hided:after {
  -webkit-transform: rotate(0);
  -ms-transform: rotate(0);
  -o-transform: rotate(0);
  transform: rotate(0)
}

.hamburger-arrow-left.collapsed {
  -webkit-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg)
}

.hamburger-arrow-left.collapsed:before {
  width: .6em;
  -webkit-transform: translate3d(.45em, .1em, 0) rotate(45deg);
  transform: translate3d(.45em, .1em, 0) rotate(45deg)
}

.hamburger-arrow-left.collapsed .hamburger-bar {
  border-radius: .2em
}

.hamburger-arrow-left.collapsed:after {
  width: .6em;
  -webkit-transform: translate3d(.45em, -.1em, 0) rotate(-45deg);
  transform: translate3d(.45em, -.1em, 0) rotate(-45deg)
}

.counter {
  text-align: center
}

.counter .counter-number-group,
.counter>.counter-number {
  font-size: 20px;
  color: #37474f
}

.counter-label {
  display: block
}

.counter-icon {
  font-size: 20px
}

.counter-lg .counter-number-group,
.counter-lg>.counter-number {
  font-size: 40px
}

.counter-lg .counter-icon {
  font-size: 40px
}

.counter-md .counter-number-group,
.counter-md>.counter-number {
  font-size: 30px
}

.counter-md .counter-icon {
  font-size: 30px
}

.counter-sm .counter-number-group,
.counter-sm>.counter-number {
  font-size: 14px
}

.counter-sm .counter-icon {
  font-size: 14px
}

.counter-sm .counter-number+.counter-number-related,
.counter-sm .counter-number-related+.counter-number {
  margin-left: 0
}

.counter-inverse {
  color: #fff
}

.counter-inverse .counter-number-group,
.counter-inverse>.counter-number {
  color: #fff
}

.counter-inverse .counter-icon {
  color: #fff
}

.panel {
  position: relative;
  margin-bottom: 2.143rem;
  background-color: #fff;
  border: 0 solid transparent;
  border-radius: .286rem;
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
  box-shadow: 0 1px 1px rgba(0, 0, 0, .05)
}

.panel-content>.row {
  padding-right: 30px;
  padding-left: 30px
}

.panel-content>.row>[class*=col-] {
  padding-right: 30px;
  padding-left: 30px
}

.panel-heading {
  border-top-left-radius: .214rem;
  border-top-right-radius: .214rem;
  position: relative;
  padding: 0;
  border-bottom: 1px solid transparent
}

.panel-heading+.alert {
  border-radius: 0
}

.panel-heading>.nav-tabs {
  border-bottom: none
}

.panel-heading-tab {
  padding: 10px 30px 0;
  background-color: #3e8ef7
}

.panel-heading-tab>.nav-tabs .nav-link {
  color: #fff
}

.panel-heading-tab>.nav-tabs .nav-link.hover,
.panel-heading-tab>.nav-tabs .nav-link:hover {
  color: #76838f
}

.panel-heading-tab>.nav-tabs .nav-link.active,
.panel-heading-tab>.nav-tabs .nav-link:active {
  color: #76838f;
  background-color: #fff
}

.panel-heading+.nav-tabs {
  margin-top: -.715rem
}

.panel-heading>.dropdown .dropdown-toggle {
  color: inherit
}

.panel-body {
  position: relative;
  padding: 30px 30px
}

.panel-body::after {
  display: block;
  clear: both;
  content: ""
}

.panel-heading+.panel-body {
  padding-top: 0
}

.panel-body .h1:first-child,
.panel-body .h2:first-child,
.panel-body .h3:first-child,
.panel-body .h4:first-child,
.panel-body .h5:first-child,
.panel-body .h6:first-child,
.panel-body h1:first-child,
.panel-body h2:first-child,
.panel-body h3:first-child,
.panel-body h4:first-child,
.panel-body h5:first-child,
.panel-body h6:first-child {
  margin-top: 0
}

.panel-body>:last-child {
  margin-bottom: 0
}

.panel-body>.list-group-dividered:only-child>.list-group-item:last-child {
  border-bottom-color: transparent
}

.panel-footer {
  border-bottom-right-radius: .214rem;
  border-bottom-left-radius: .214rem;
  padding: 0 30px 15px;
  background-color: transparent;
  border-top: 1px solid transparent
}

.table+.panel-footer {
  padding-top: 15px;
  border-color: #e4eaec
}

.panel-title {
  display: block;
  padding: 20px 30px;
  margin-top: 0;
  margin-bottom: 0;
  font-size: 18px;
  color: #37474f
}

.panel-title>.icon {
  margin-right: 10px
}

.panel-title>.badge {
  margin-left: 10px
}

.panel-title .small,
.panel-title small {
  color: #76838f
}

.panel-title>.small>a,
.panel-title>a,
.panel-title>small>a {
  color: inherit
}

.panel-desc {
  display: block;
  padding: 5px 0 0;
  margin: 0;
  font-size: 1rem;
  color: #76838f
}

.panel-actions {
  position: absolute;
  top: 50%;
  right: 30px;
  z-index: 1;
  margin: auto;
  -webkit-transform: translate(0, -50%);
  -ms-transform: translate(0, -50%);
  -o-transform: translate(0, -50%);
  transform: translate(0, -50%)
}

@media (max-width:479px) {
  .panel-actions {
    right: 20px
  }
}

ul .panel-actions {
  list-style: none
}

ul .panel-actions>li {
  display: inline-block;
  margin-left: 8px
}

ul .panel-actions>li:first-child {
  margin-left: 0
}

.panel-actions a.dropdown-toggle {
  text-decoration: none
}

.panel-actions .dropdown {
  display: inline-block
}

.panel-actions .dropdown-toggle {
  display: inline-block
}

.panel-actions .panel-action {
  display: inline-block;
  padding: 8px 10px;
  color: #a3afb7;
  text-decoration: none;
  cursor: pointer;
  background-color: transparent
}

.panel-actions .panel-action:hover {
  color: #526069
}

.panel-actions .panel-action:active {
  color: #526069
}

.panel-actions .panel-action[data-toggle=dropdown]:not(.dropdown-toggle) {
  width: 34px;
  text-align: center
}

.panel-actions .progress {
  width: 100px;
  margin: 0
}

.panel-actions .pagination {
  margin: 0
}

ul.panel-actions {
  list-style: none
}

ul.panel-actions>li {
  display: inline-block;
  margin-left: 8px
}

ul.panel-actions>li:first-child {
  margin-left: 0
}

.panel-toolbar {
  padding: 5px 15px;
  margin: 0;
  background-color: transparent;
  border-top: 1px solid #e4eaec;
  border-bottom: 1px solid #e4eaec
}

.panel-bordered .panel-toolbar {
  border-top-color: transparent
}

.panel-toolbar .btn {
  padding: 5px 10px;
  color: #a3afb7
}

.panel-toolbar .btn.icon {
  width: 1em;
  text-align: center
}

.panel-toolbar .btn.active,
.panel-toolbar .btn:active,
.panel-toolbar .btn:hover {
  color: #76838f
}

.panel-loading {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 6;
  display: none;
  width: 100%;
  height: 100%;
  border-radius: .286rem;
  opacity: .6
}

.panel-loading .loader {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  -o-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%)
}

.panel>:not(.panel-loading):not(.collapsing) {
  -webkit-transition: opacity .3s;
  -o-transition: opacity .3s;
  transition: opacity .3s
}

.panel.is-loading>:not(.panel-loading) {
  opacity: .3
}

.panel.is-loading .panel-loading {
  display: block;
  opacity: 1
}

.panel-footer-chart {
  padding: 0
}

.panel-control {
  padding: 0;
  border: none;
  border-radius: 0;
  -webkit-box-shadow: none;
  box-shadow: none
}

.panel-body.scrollable-vertical {
  padding-right: 0 !important;
  padding-left: 0 !important
}

.panel-body.scrollable-vertical>.scrollable-container>.scrollable-content {
  padding-right: 30px;
  padding-left: 30px
}

@media (max-width:479px) {
  .panel-body.scrollable-vertical>.scrollable-container>.scrollable-content {
    padding-right: 20px;
    padding-left: 20px
  }
}

.panel-body.scrollable-vertical>.scrollable-bar {
  height: -webkit-calc(100% - 30px);
  height: calc(100% - 30px);
  margin-top: 0;
  margin-bottom: 30px;
  -webkit-transform: translateX(-26px);
  -ms-transform: translateX(-26px);
  -o-transform: translateX(-26px);
  transform: translateX(-26px)
}

.panel-bordered>.panel-body.scrollable-vertical>.scrollable-bar {
  height: -webkit-calc(100% - 2 * 30px);
  height: calc(100% - 2 * 30px);
  margin-bottom: 30px
}

.panel-body.scrollable-horizontal {
  padding-top: 0 !important;
  padding-bottom: 0 !important
}

.panel-body.scrollable-horizontal>.scrollable-container>.scrollable-content {
  padding-top: 0;
  padding-bottom: 30px
}

.panel-bordered>.panel-body.scrollable-horizontal>.scrollable-container>.scrollable-content {
  padding-top: 30px;
  padding-bottom: 30px
}

.panel-body.scrollable-horizontal>.scrollable-bar {
  width: -webkit-calc(100% - 2 * 30px);
  width: calc(100% - 2 * 30px);
  margin-right: 30px;
  margin-left: 0;
  -webkit-transform: translateY(-26px);
  -ms-transform: translateY(-26px);
  -o-transform: translateY(-26px);
  transform: translateY(-26px)
}

@media (max-width:479px) {
  .panel-body.scrollable-horizontal>.scrollable-bar {
    width: -webkit-calc(100% - 2* 20px);
    width: calc(100% - 2* 20px);
    margin-right: 20px
  }
}

.panel-bordered>.panel-body.scrollable-horizontal>.scrollable-bar {
  -webkit-transform: translateY(-26px);
  -ms-transform: translateY(-26px);
  -o-transform: translateY(-26px);
  transform: translateY(-26px)
}

.panel-bordered>.panel-heading {
  border-bottom: 1px solid #e4eaec
}

.panel-bordered>.panel-heading>.panel-title {
  padding-bottom: 20px
}

.panel-bordered>.panel-footer {
  padding-top: 15px;
  border-top: 1px solid #e4eaec
}

.panel-bordered>.panel-body {
  padding-top: 30px
}

.panel-bordered>.table>tbody:first-child>tr:first-child td,
.panel-bordered>.table>tbody:first-child>tr:first-child th {
  border-top: 0
}

.panel.is-dragging {
  opacity: .8
}

.panel.is-dragging {
  cursor: move
}

.panel>.nav-tabs-vertical .nav-tabs {
  margin-left: -1px
}

.panel>.nav-tabs-vertical .nav-tabs>li>a {
  border-left: none;
  border-radius: 0
}

.panel>.nav-tabs-vertical .nav-tabs.nav-tabs-reverse {
  margin-right: -1px
}

.panel>.nav-tabs-vertical .nav-tabs.nav-tabs-reverse>li>a {
  border-right: none;
  border-radius: 0
}

.panel:hover .panel-actions .show-on-hover {
  display: inline-block
}

.panel .panel-actions .show-on-hover {
  display: none
}

.panel.is-fullscreen {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 9999;
  width: 100%;
  height: 100%;
  border-radius: 0
}

.panel.is-fullscreen .panel-loading {
  border-radius: 0
}

.panel.is-fullscreen .panel-actions [data-toggle=collapse] {
  display: none
}

.panel.is-close {
  display: none
}

.panel.is-collapse .panel-body {
  display: none;
  height: 0
}

.panel>.alert {
  padding-right: 30px;
  padding-left: 30px
}

@media (max-width:479px) {
  .panel>.alert {
    padding-right: 20px;
    padding-left: 20px
  }

  .panel>.alert-dismissible {
    padding-right: 40px
  }
}

.panel>.alert-dismissible {
  padding-right: 50px
}

.panel>.panel-collapse>.table,
.panel>.table,
.panel>.table-responsive>.table {
  margin-bottom: 0
}

.panel>.panel-collapse>.table caption,
.panel>.table caption,
.panel>.table-responsive>.table caption {
  padding-right: 30px 30px;
  padding-left: 30px 30px
}

.panel>.table-responsive:first-child>.table:first-child,
.panel>.table:first-child {
  border-top-left-radius: .214rem;
  border-top-right-radius: .214rem
}

.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child,
.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child,
.panel>.table:first-child>tbody:first-child>tr:first-child,
.panel>.table:first-child>thead:first-child>tr:first-child {
  border-top-left-radius: .214rem;
  border-top-right-radius: .214rem
}

.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child td:first-child,
.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child th:first-child,
.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child td:first-child,
.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child th:first-child,
.panel>.table:first-child>tbody:first-child>tr:first-child td:first-child,
.panel>.table:first-child>tbody:first-child>tr:first-child th:first-child,
.panel>.table:first-child>thead:first-child>tr:first-child td:first-child,
.panel>.table:first-child>thead:first-child>tr:first-child th:first-child {
  border-top-left-radius: .214rem
}

.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child td:last-child,
.panel>.table-responsive:first-child>.table:first-child>tbody:first-child>tr:first-child th:last-child,
.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child td:last-child,
.panel>.table-responsive:first-child>.table:first-child>thead:first-child>tr:first-child th:last-child,
.panel>.table:first-child>tbody:first-child>tr:first-child td:last-child,
.panel>.table:first-child>tbody:first-child>tr:first-child th:last-child,
.panel>.table:first-child>thead:first-child>tr:first-child td:last-child,
.panel>.table:first-child>thead:first-child>tr:first-child th:last-child {
  border-top-right-radius: .214rem
}

.panel>.table-responsive:last-child>.table:last-child,
.panel>.table:last-child {
  border-bottom-right-radius: .214rem;
  border-bottom-left-radius: .214rem
}

.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child,
.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child,
.panel>.table:last-child>tbody:last-child>tr:last-child,
.panel>.table:last-child>tfoot:last-child>tr:last-child {
  border-bottom-right-radius: .214rem;
  border-bottom-left-radius: .214rem
}

.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child td:first-child,
.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child th:first-child,
.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child td:first-child,
.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child th:first-child,
.panel>.table:last-child>tbody:last-child>tr:last-child td:first-child,
.panel>.table:last-child>tbody:last-child>tr:last-child th:first-child,
.panel>.table:last-child>tfoot:last-child>tr:last-child td:first-child,
.panel>.table:last-child>tfoot:last-child>tr:last-child th:first-child {
  border-bottom-left-radius: .214rem
}

.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child td:last-child,
.panel>.table-responsive:last-child>.table:last-child>tbody:last-child>tr:last-child th:last-child,
.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child td:last-child,
.panel>.table-responsive:last-child>.table:last-child>tfoot:last-child>tr:last-child th:last-child,
.panel>.table:last-child>tbody:last-child>tr:last-child td:last-child,
.panel>.table:last-child>tbody:last-child>tr:last-child th:last-child,
.panel>.table:last-child>tfoot:last-child>tr:last-child td:last-child,
.panel>.table:last-child>tfoot:last-child>tr:last-child th:last-child {
  border-bottom-right-radius: .214rem
}

.panel>.panel-body+.table,
.panel>.panel-body+.table-responsive,
.panel>.table+.panel-body,
.panel>.table-responsive+.panel-body {
  border-top: 1px solid #e4eaec
}

.panel>.table>tbody:first-child>tr:first-child td,
.panel>.table>tbody:first-child>tr:first-child th {
  border-top: 0
}

.panel>.table-bordered,
.panel>.table-responsive>.table-bordered {
  border: 0
}

.panel>.table-bordered>tbody>tr>td:first-child,
.panel>.table-bordered>tbody>tr>th:first-child,
.panel>.table-bordered>tfoot>tr>td:first-child,
.panel>.table-bordered>tfoot>tr>th:first-child,
.panel>.table-bordered>thead>tr>td:first-child,
.panel>.table-bordered>thead>tr>th:first-child,
.panel>.table-responsive>.table-bordered>tbody>tr>td:first-child,
.panel>.table-responsive>.table-bordered>tbody>tr>th:first-child,
.panel>.table-responsive>.table-bordered>tfoot>tr>td:first-child,
.panel>.table-responsive>.table-bordered>tfoot>tr>th:first-child,
.panel>.table-responsive>.table-bordered>thead>tr>td:first-child,
.panel>.table-responsive>.table-bordered>thead>tr>th:first-child {
  border-left: 0
}

.panel>.table-bordered>tbody>tr>td:last-child,
.panel>.table-bordered>tbody>tr>th:last-child,
.panel>.table-bordered>tfoot>tr>td:last-child,
.panel>.table-bordered>tfoot>tr>th:last-child,
.panel>.table-bordered>thead>tr>td:last-child,
.panel>.table-bordered>thead>tr>th:last-child,
.panel>.table-responsive>.table-bordered>tbody>tr>td:last-child,
.panel>.table-responsive>.table-bordered>tbody>tr>th:last-child,
.panel>.table-responsive>.table-bordered>tfoot>tr>td:last-child,
.panel>.table-responsive>.table-bordered>tfoot>tr>th:last-child,
.panel>.table-responsive>.table-bordered>thead>tr>td:last-child,
.panel>.table-responsive>.table-bordered>thead>tr>th:last-child {
  border-right: 0
}

.panel>.table-bordered>tbody>tr:first-child>td,
.panel>.table-bordered>tbody>tr:first-child>th,
.panel>.table-bordered>thead>tr:first-child>td,
.panel>.table-bordered>thead>tr:first-child>th,
.panel>.table-responsive>.table-bordered>tbody>tr:first-child>td,
.panel>.table-responsive>.table-bordered>tbody>tr:first-child>th,
.panel>.table-responsive>.table-bordered>thead>tr:first-child>td,
.panel>.table-responsive>.table-bordered>thead>tr:first-child>th {
  border-bottom: 0
}

.panel>.table-bordered>tbody>tr:last-child>td,
.panel>.table-bordered>tbody>tr:last-child>th,
.panel>.table-bordered>tfoot>tr:last-child>td,
.panel>.table-bordered>tfoot>tr:last-child>th,
.panel>.table-responsive>.table-bordered>tbody>tr:last-child>td,
.panel>.table-responsive>.table-bordered>tbody>tr:last-child>th,
.panel>.table-responsive>.table-bordered>tfoot>tr:last-child>td,
.panel>.table-responsive>.table-bordered>tfoot>tr:last-child>th {
  border-bottom: 0
}

.panel>.table-responsive {
  margin-bottom: 0;
  border: 0
}

.panel>.table-responsive .table>tbody>tr>td:first-child,
.panel>.table-responsive .table>tbody>tr>th:first-child,
.panel>.table-responsive .table>tfoot>tr>td:first-child,
.panel>.table-responsive .table>tfoot>tr>th:first-child,
.panel>.table-responsive .table>thead>tr>td:first-child,
.panel>.table-responsive .table>thead>tr>th:first-child,
.panel>.table-responsive .table>tr>td:first-child,
.panel>.table-responsive .table>tr>th:first-child,
.panel>.table>tbody>tr>td:first-child,
.panel>.table>tbody>tr>th:first-child,
.panel>.table>tfoot>tr>td:first-child,
.panel>.table>tfoot>tr>th:first-child,
.panel>.table>thead>tr>td:first-child,
.panel>.table>thead>tr>th:first-child,
.panel>.table>tr>td:first-child,
.panel>.table>tr>th:first-child {
  padding-left: 30px
}

@media (max-width:479px) {

  .panel>.table-responsive .table>tbody>tr>td:first-child,
  .panel>.table-responsive .table>tbody>tr>th:first-child,
  .panel>.table-responsive .table>tfoot>tr>td:first-child,
  .panel>.table-responsive .table>tfoot>tr>th:first-child,
  .panel>.table-responsive .table>thead>tr>td:first-child,
  .panel>.table-responsive .table>thead>tr>th:first-child,
  .panel>.table-responsive .table>tr>td:first-child,
  .panel>.table-responsive .table>tr>th:first-child,
  .panel>.table>tbody>tr>td:first-child,
  .panel>.table>tbody>tr>th:first-child,
  .panel>.table>tfoot>tr>td:first-child,
  .panel>.table>tfoot>tr>th:first-child,
  .panel>.table>thead>tr>td:first-child,
  .panel>.table>thead>tr>th:first-child,
  .panel>.table>tr>td:first-child,
  .panel>.table>tr>th:first-child {
    padding-left: 20px
  }
}

.panel>.table-responsive .table>tbody>tr>td:last-child,
.panel>.table-responsive .table>tbody>tr>th:last-child,
.panel>.table-responsive .table>tfoot>tr>td:last-child,
.panel>.table-responsive .table>tfoot>tr>th:last-child,
.panel>.table-responsive .table>thead>tr>td:last-child,
.panel>.table-responsive .table>thead>tr>th:last-child,
.panel>.table-responsive .table>tr>td:last-child,
.panel>.table-responsive .table>tr>th:last-child,
.panel>.table>tbody>tr>td:last-child,
.panel>.table>tbody>tr>th:last-child,
.panel>.table>tfoot>tr>td:last-child,
.panel>.table>tfoot>tr>th:last-child,
.panel>.table>thead>tr>td:last-child,
.panel>.table>thead>tr>th:last-child,
.panel>.table>tr>td:last-child,
.panel>.table>tr>th:last-child {
  padding-right: 30px
}

@media (max-width:479px) {

  .panel>.table-responsive .table>tbody>tr>td:last-child,
  .panel>.table-responsive .table>tbody>tr>th:last-child,
  .panel>.table-responsive .table>tfoot>tr>td:last-child,
  .panel>.table-responsive .table>tfoot>tr>th:last-child,
  .panel>.table-responsive .table>thead>tr>td:last-child,
  .panel>.table-responsive .table>thead>tr>th:last-child,
  .panel>.table-responsive .table>tr>td:last-child,
  .panel>.table-responsive .table>tr>th:last-child,
  .panel>.table>tbody>tr>td:last-child,
  .panel>.table>tbody>tr>th:last-child,
  .panel>.table>tfoot>tr>td:last-child,
  .panel>.table>tfoot>tr>th:last-child,
  .panel>.table>thead>tr>td:last-child,
  .panel>.table>thead>tr>th:last-child,
  .panel>.table>tr>td:last-child,
  .panel>.table>tr>th:last-child {
    padding-right: 20px
  }
}

.panel>.table>tbody:first-child>tr:first-child td,
.panel>.table>tbody:first-child>tr:first-child th {
  border-top: 1px solid #e4eaec
}

.panel>.list-group,
.panel>.panel-collapse>.list-group {
  margin-bottom: 0
}

.panel>.list-group .list-group-item,
.panel>.panel-collapse>.list-group .list-group-item {
  border-width: 1px 0;
  border-radius: 0
}

.panel>.list-group:first-child .list-group-item:first-child,
.panel>.panel-collapse>.list-group:first-child .list-group-item:first-child {
  border-top-left-radius: .214rem;
  border-top-right-radius: .214rem;
  border-top: 0
}

.panel>.list-group:last-child .list-group-item:last-child,
.panel>.panel-collapse>.list-group:last-child .list-group-item:last-child {
  border-bottom-right-radius: .214rem;
  border-bottom-left-radius: .214rem;
  border-bottom: 0
}

.panel>.panel-heading+.panel-collapse>.list-group .list-group-item:first-child {
  border-top-left-radius: 0;
  border-top-right-radius: 0
}

.panel>.list-group .list-group-item {
  padding-right: 30px;
  padding-left: 30px
}

@media (max-width:479px) {
  .panel>.list-group .list-group-item {
    padding-right: 20px;
    padding-left: 20px
  }
}

.panel-heading+.list-group .list-group-item:first-child {
  border-top-width: 0
}

.list-group+.panel-footer {
  border-top-width: 0
}

.panel.panel-transparent {
  background: 0 0;
  border-color: transparent;
  -webkit-box-shadow: none;
  box-shadow: none
}

.panel.panel-transparent>.panel-footer,
.panel.panel-transparent>.panel-heading {
  border-color: transparent
}

.panel-default .panel-heading {
  color: #76838f;
  background-color: #e4eaec;
  border: none
}

.panel-default .panel-heading+.panel-collapse>.panel-body {
  border-top-color: #e4eaec
}

.panel-default .panel-heading .badge-pill {
  color: #e4eaec;
  background-color: #76838f
}

.panel-default .panel-title {
  color: #76838f
}

.panel-default .panel-action {
  color: #76838f
}

.panel-default .panel-footer+.panel-collapse>.panel-body {
  border-bottom-color: #e4eaec
}

.panel-default .panel-title {
  color: #37474f
}

.panel-primary .panel-heading {
  color: #fff;
  background-color: #3e8ef7;
  border: none
}

.panel-primary .panel-heading+.panel-collapse>.panel-body {
  border-top-color: #3e8ef7
}

.panel-primary .panel-heading .badge-pill {
  color: #3e8ef7;
  background-color: #fff
}

.panel-primary .panel-title {
  color: #fff
}

.panel-primary .panel-action {
  color: #fff
}

.panel-primary .panel-footer+.panel-collapse>.panel-body {
  border-bottom-color: #3e8ef7
}

.panel-success .panel-heading {
  color: #fff;
  background-color: #11c26d;
  border: none
}

.panel-success .panel-heading+.panel-collapse>.panel-body {
  border-top-color: #0fab46
}

.panel-success .panel-heading .badge-pill {
  color: #11c26d;
  background-color: #fff
}

.panel-success .panel-title {
  color: #fff
}

.panel-success .panel-action {
  color: #fff
}

.panel-success .panel-footer+.panel-collapse>.panel-body {
  border-bottom-color: #0fab46
}

.panel-info .panel-heading {
  color: #fff;
  background-color: #0bb2d4;
  border: none
}

.panel-info .panel-heading+.panel-collapse>.panel-body {
  border-top-color: #09b2b2
}

.panel-info .panel-heading .badge-pill {
  color: #0bb2d4;
  background-color: #fff
}

.panel-info .panel-title {
  color: #fff
}

.panel-info .panel-action {
  color: #fff
}

.panel-info .panel-footer+.panel-collapse>.panel-body {
  border-bottom-color: #09b2b2
}

.panel-warning .panel-heading {
  color: #fff;
  background-color: #eb6709;
  border: none
}

.panel-warning .panel-heading+.panel-collapse>.panel-body {
  border-top-color: #dc3d08
}

.panel-warning .panel-heading .badge-pill {
  color: #eb6709;
  background-color: #fff
}

.panel-warning .panel-title {
  color: #fff
}

.panel-warning .panel-action {
  color: #fff
}

.panel-warning .panel-footer+.panel-collapse>.panel-body {
  border-bottom-color: #dc3d08
}

.panel-danger .panel-heading {
  color: #fff;
  background-color: #ff4c52;
  border: none
}

.panel-danger .panel-heading+.panel-collapse>.panel-body {
  border-top-color: #ff3d64
}

.panel-danger .panel-heading .badge-pill {
  color: #ff4c52;
  background-color: #fff
}

.panel-danger .panel-title {
  color: #fff
}

.panel-danger .panel-action {
  color: #fff
}

.panel-danger .panel-footer+.panel-collapse>.panel-body {
  border-bottom-color: #ff3d64
}

.panel-dark .panel-heading {
  color: #fff;
  background-color: #526069;
  border: none
}

.panel-dark .panel-heading+.panel-collapse>.panel-body {
  border-top-color: #526069
}

.panel-dark .panel-heading .badge-pill {
  color: #526069;
  background-color: #fff
}

.panel-dark .panel-title {
  color: #fff
}

.panel-dark .panel-action {
  color: #fff
}

.panel-dark .panel-footer+.panel-collapse>.panel-body {
  border-bottom-color: #526069
}

.panel-line .panel-heading {
  background: 0 0;
  border: none;
  border-top: 3px solid transparent
}

.panel-line.panel-default .panel-heading {
  color: #e4eaec;
  background: 0 0;
  border-top-color: #e4eaec
}

.panel-line.panel-default .panel-title {
  color: #e4eaec
}

.panel-line.panel-default .panel-action {
  color: #e4eaec
}

.panel-line.panel-default .panel-title {
  color: #37474f
}

.panel-line.panel-default .panel-action {
  color: #a3afb7
}

.panel-line.panel-primary .panel-heading {
  color: #3e8ef7;
  background: 0 0;
  border-top-color: #3e8ef7
}

.panel-line.panel-primary .panel-title {
  color: #3e8ef7
}

.panel-line.panel-primary .panel-action {
  color: #3e8ef7
}

.panel-line.panel-success .panel-heading {
  color: #11c26d;
  background: 0 0;
  border-top-color: #11c26d
}

.panel-line.panel-success .panel-title {
  color: #11c26d
}

.panel-line.panel-success .panel-action {
  color: #11c26d
}

.panel-line.panel-info .panel-heading {
  color: #0bb2d4;
  background: 0 0;
  border-top-color: #0bb2d4
}

.panel-line.panel-info .panel-title {
  color: #0bb2d4
}

.panel-line.panel-info .panel-action {
  color: #0bb2d4
}

.panel-line.panel-warning .panel-heading {
  color: #eb6709;
  background: 0 0;
  border-top-color: #eb6709
}

.panel-line.panel-warning .panel-title {
  color: #eb6709
}

.panel-line.panel-warning .panel-action {
  color: #eb6709
}

.panel-line.panel-danger .panel-heading {
  color: #ff4c52;
  background: 0 0;
  border-top-color: #ff4c52
}

.panel-line.panel-danger .panel-title {
  color: #ff4c52
}

.panel-line.panel-danger .panel-action {
  color: #ff4c52
}

.panel-line.panel-dark .panel-heading {
  color: #526069;
  background: 0 0;
  border-top-color: #526069
}

.panel-line.panel-dark .panel-title {
  color: #526069
}

.panel-line.panel-dark .panel-action {
  color: #526069
}

@media (max-width:767px) {
  .panel-actions {
    position: relative;
    top: auto;
    right: auto;
    display: block;
    padding: 0 30px 15px;
    margin: auto;
    -webkit-transform: none;
    -ms-transform: none;
    -o-transform: none;
    transform: none
  }

  .panel-actions-keep {
    position: absolute;
    top: 50%;
    right: 30px;
    padding: 0;
    -webkit-transform: translate(0, -50%);
    -ms-transform: translate(0, -50%);
    -o-transform: translate(0, -50%);
    transform: translate(0, -50%)
  }
}

@media (max-width:479px) {
  .panel-actions {
    padding-left: 20px
  }

  .panel-actions-keep {
    right: 15px
  }

  .panel-actions .progress {
    min-width: 80px
  }

  .panel-actions .show-on-hover {
    display: none
  }

  .panel-body,
  .panel-footer,
  .panel-title {
    padding-right: 20px;
    padding-left: 20px
  }
}

.panel-group {
  margin-bottom: 22px
}

.panel-group .panel {
  margin-bottom: 0;
  border-radius: .286rem;
  -webkit-box-shadow: none;
  box-shadow: none
}

.panel-group .panel+.panel {
  margin-top: 10px
}

.panel-group .panel-title {
  position: relative;
  padding: 15px 30px;
  font-size: 1rem
}

.panel-group .panel-title:after,
.panel-group .panel-title:before {
  position: absolute;
  top: 15px;
  right: 30px;
  font-family: "Web Icons";
  -webkit-transition: all .3s linear 0s;
  -o-transition: all .3s linear 0s;
  transition: all .3s linear 0s
}

.panel-group .panel-title:before {
  content: ""
}

.panel-group .panel-title:after {
  content: ""
}

.panel-group .panel-title[aria-expanded=false]:before {
  opacity: .4
}

.panel-group .panel-title[aria-expanded=false]:after {
  opacity: 0;
  -webkit-transform: rotate(-180deg);
  -ms-transform: rotate(-180deg);
  -o-transform: rotate(-180deg);
  transform: rotate(-180deg)
}

.panel-group .panel-title[aria-expanded=true]:before {
  opacity: 0;
  -webkit-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg)
}

.panel-group .panel-title[aria-expanded=true]:after {
  opacity: 1
}

.panel-group .panel-title:focus,
.panel-group .panel-title:hover {
  color: #76838f;
  text-decoration: none
}

.panel-group .panel-title:focus {
  outline: 0
}

.panel-group .panel-heading {
  border-bottom: 0
}

.panel-group .panel-heading+.panel-collapse {
  margin: 0
}

.panel-group .panel-heading+.panel-collapse>.list-group {
  border-top: 1px solid #e4eaec
}

.panel-group .panel-collapse .panel-body {
  padding: 15px 30px
}

.panel-group .panel-footer {
  border-top: 0
}

.panel-group .panel-footer+.panel-collapse .panel-body {
  border-bottom: 1px solid #e4eaec
}

.panel-group-continuous .panel {
  border-radius: 0
}

.panel-group-continuous .panel:first-child {
  border-radius: .286rem .286rem 0 0
}

.panel-group-continuous .panel:last-child {
  border-radius: 0 0 .286rem .286rem
}

.panel-group-continuous .panel+.panel {
  margin-top: 0;
  border-top: 1px solid #e4eaec
}

.panel-group-simple .panel {
  background: 0 0
}

.panel-group-simple .panel-title {
  padding-bottom: 10px;
  padding-left: 0
}

.panel-group-simple .panel-title:after,
.panel-group-simple .panel-title:before {
  right: 5px
}

.panel-group-simple .panel-collapse .panel-body {
  padding-top: 10px;
  padding-right: 0;
  padding-left: 0
}

.panel-group-simple .panel+.panel {
  margin-top: 0
}

.cover {
  overflow: hidden
}

.cover-background {
  height: 100%;
  background-repeat: no-repeat;
  background-position: center;
  -webkit-background-size: cover;
  background-size: cover
}

.cover-image {
  width: 100%
}

.blockquote.cover-quote,
.cover-quote {
  position: relative;
  padding-left: 35px;
  margin-bottom: 0;
  border-left: none
}

.blockquote.cover-quote:after,
.blockquote.cover-quote:before,
.cover-quote:after,
.cover-quote:before {
  position: absolute;
  top: -20px;
  font-size: 4em
}

.blockquote.cover-quote:before,
.cover-quote:before {
  left: 0;
  content: open-quote
}

.blockquote.cover-quote:after,
.cover-quote:after {
  right: 0;
  visibility: hidden;
  content: close-quote
}

.blockquote.cover-quote.blockquote-reverse,
.cover-quote.blockquote-reverse {
  padding-right: 35px;
  padding-left: 20px;
  border-right: none
}

.blockquote.cover-quote.blockquote-reverse:before,
.cover-quote.blockquote-reverse:before {
  right: 0;
  left: auto;
  content: close-quote
}

.cover-gallery .carousel-inner img {
  width: 100%
}

.cover-iframe {
  width: 100%;
  border: 0 none
}

.overlay {
  position: relative;
  display: inline-block;
  width: 100%;
  max-width: 100%;
  margin: 0;
  overflow: hidden;
  vertical-align: middle;
  -webkit-transform: translateZ(0);
  transform: translateZ(0)
}

.overlay-figure {
  width: 100%;
  max-width: 100%;
  margin-bottom: 0
}

.overlay-panel {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 20px;
  color: #fff
}

.overlay-panel a:not([class]) {
  color: inherit;
  text-decoration: underline
}

.overlay-panel>:last-child {
  margin-bottom: 0
}

.overlay-panel h1,
.overlay-panel h2,
.overlay-panel h3,
.overlay-panel h4,
.overlay-panel h5,
.overlay-panel h6 {
  color: inherit
}

.overlay-hover:not(:hover) .overlay-panel:not(.overlay-background-fixed) {
  opacity: 0
}

.overlay-background {
  background: rgba(0, 0, 0, .5)
}

.overlay-image {
  width: 100%;
  max-width: 100%;
  padding: 0
}

.overlay-shade {
  background: transparent -webkit-gradient(linear, left top, left bottom, color-stop(50%, rgba(255, 255, 255, 0)), color-stop(90%, rgba(255, 255, 255, .87)), to(#fff)) repeat scroll 0 0;
  background: transparent -webkit-linear-gradient(top, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, .87) 90%, #fff 100%) repeat scroll 0 0;
  background: transparent -o-linear-gradient(top, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, .87) 90%, #fff 100%) repeat scroll 0 0;
  background: transparent linear-gradient(to bottom, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, .87) 90%, #fff 100%) repeat scroll 0 0
}

.overlay-top {
  bottom: auto
}

.overlay-bottom {
  top: auto
}

.overlay-left {
  right: auto
}

.overlay-right {
  left: auto
}

.overlay-icon {
  font-size: 0;
  text-align: center
}

.overlay-icon:before {
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  content: ""
}

.overlay-icon .icon {
  display: inline-block;
  width: 2.286rem;
  height: 2.286rem;
  margin-right: 10px;
  margin-left: 10px;
  font-size: 2.286rem;
  line-height: 1;
  color: #fff;
  text-decoration: none
}

.overlay-anchor {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0
}

.overlay-blur,
.overlay-fade,
.overlay-grayscale,
.overlay-scale,
.overlay-spin,
[class*=overlay-slide] {
  -webkit-transition-timing-function: ease-out;
  -o-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
  -webkit-transition-duration: .3s;
  -o-transition-duration: .3s;
  transition-duration: .3s;
  -webkit-transition-property: opacity -webkit-transform -webkit-filter, opacity -webkit-transform filter;
  -o-transition-property: opacity -o-transform filter;
  transition-property: opacity transform filter
}

.overlay-fade {
  opacity: .7
}

.overlay-hover:hover .overlay-fade {
  opacity: 1
}

.overlay-scale {
  -webkit-transform: scale(1);
  -ms-transform: scale(1);
  -o-transform: scale(1);
  transform: scale(1)
}

.overlay-hover:hover .overlay-scale {
  -webkit-transform: scale(1.1);
  -ms-transform: scale(1.1);
  -o-transform: scale(1.1);
  transform: scale(1.1)
}

.overlay-spin {
  -webkit-transform: scale(1) rotate(0);
  -ms-transform: scale(1) rotate(0);
  -o-transform: scale(1) rotate(0);
  transform: scale(1) rotate(0)
}

.overlay-hover:hover .overlay-spin {
  -webkit-transform: scale(1.1) rotate(3deg);
  -ms-transform: scale(1.1) rotate(3deg);
  -o-transform: scale(1.1) rotate(3deg);
  transform: scale(1.1) rotate(3deg)
}

.overlay-grayscale {
  -webkit-filter: grayscale(100%);
  filter: grayscale(100%)
}

.overlay-hover:hover .overlay-grayscale {
  -webkit-filter: grayscale(0);
  filter: grayscale(0)
}

[class*=overlay-slide] {
  opacity: 0
}

.overlay-slide-top {
  -webkit-transform: translateY(-100%);
  -ms-transform: translateY(-100%);
  -o-transform: translateY(-100%);
  transform: translateY(-100%)
}

.overlay-slide-bottom {
  -webkit-transform: translateY(100%);
  -ms-transform: translateY(100%);
  -o-transform: translateY(100%);
  transform: translateY(100%)
}

.overlay-slide-left {
  -webkit-transform: translateX(-100%);
  -ms-transform: translateX(-100%);
  -o-transform: translateX(-100%);
  transform: translateX(-100%)
}

.overlay-slide-right {
  -webkit-transform: translateX(100%);
  -ms-transform: translateX(100%);
  -o-transform: translateX(100%);
  transform: translateX(100%)
}

.overlay-hover:hover [class*=overlay-slide] {
  opacity: 1;
  -webkit-transform: translateX(0) translateY(0);
  -ms-transform: translateX(0) translateY(0);
  -o-transform: translateX(0) translateY(0);
  transform: translateX(0) translateY(0)
}

.comments {
  padding: 0;
  margin: 0
}

.comments .comment {
  border: none;
  border-bottom: 1px solid #e4eaec
}

.comments .comment .comment:first-child {
  border-top: 1px solid #e4eaec
}

.comments .comment .comment:last-child {
  border-bottom: none
}

.comment {
  padding: 20px 0;
  margin: 0
}

.comment .comment {
  padding-bottom: 20px;
  margin-top: 20px
}

.comment .comment:last-child {
  padding-bottom: 0
}

.comment-author,
.comment-author:focus,
.comment-author:hover {
  color: #37474f
}

.comment-meta {
  display: inline-block;
  margin-left: 5px;
  font-size: .858rem;
  color: #a3afb7
}

.comment-content {
  margin-top: 5px
}

.comment-content p:last-child {
  margin-bottom: 0
}

.comment-actions {
  margin-top: 10px;
  text-align: right
}

.comment-actions a {
  display: inline-block;
  margin-right: 10px;
  vertical-align: middle
}

.comment-actions a.icon {
  text-decoration: none
}

.comment-actions a:last-child {
  margin-right: 0
}

.comment-reply {
  margin: 22px 0 10px
}

.comment-reply .form-group:last-child {
  margin-bottom: 0
}

.chat-box {
  width: 100%;
  height: 100%;
  overflow: hidden;
  background-color: #fff
}

.chats {
  padding: 30px 15px
}

.chat-avatar {
  float: right
}

.chat-avatar .avatar {
  width: 30px
}

.chat-body {
  display: block;
  margin: 10px 30px 0 0;
  overflow: hidden
}

.chat-body:first-child {
  margin-top: 0
}

.chat-content {
  position: relative;
  display: block;
  float: right;
  padding: 8px 15px;
  margin: 0 20px 10px 0;
  clear: both;
  color: #fff;
  background-color: #3e8ef7;
  border-radius: .286rem
}

.chat-content:before {
  position: absolute;
  top: 10px;
  right: -10px;
  width: 0;
  height: 0;
  content: "";
  border: 5px solid transparent;
  border-left-color: #3e8ef7
}

.chat-content p {
  margin-bottom: .5rem
}

.chat-content>p:last-child {
  margin-bottom: 0
}

.chat-content+.chat-content:before {
  border-color: transparent
}

.chat-time {
  display: block;
  margin-top: 8px;
  color: rgba(255, 255, 255, .6)
}

.chat-left .chat-avatar {
  float: left
}

.chat-left .chat-body {
  margin-right: 0;
  margin-left: 30px
}

.chat-left .chat-content {
  float: left;
  margin: 0 0 10px 20px;
  color: #76838f;
  background-color: #dfe9ef
}

.chat-left .chat-content:before {
  right: auto;
  left: -10px;
  border-right-color: #dfe9ef;
  border-left-color: transparent
}

.chat-left .chat-content+.chat-content:before {
  border-color: transparent
}

.chat-left .chat-time {
  color: #a3afb7
}

.steps {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-flex-wrap: wrap;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  margin: 0 0 22px
}

.step {
  position: relative;
  padding: 12px 20px;
  margin: 0;
  font-size: inherit;
  color: #a3afb7;
  vertical-align: top;
  background-color: #f3f7f9;
  border-radius: 0
}

.step-icon {
  float: left;
  margin-right: .5em;
  font-size: 20px
}

.step-number {
  position: absolute;
  top: 50%;
  left: 20px;
  width: 40px;
  height: 40px;
  font-size: 24px;
  line-height: 40px;
  color: #fff;
  text-align: center;
  background: #e4eaec;
  border-radius: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%)
}

.step-number~.step-desc {
  min-height: 40px;
  margin-left: 50px
}

.step-title {
  margin-bottom: 0;
  font-size: 20px;
  color: #526069
}

.step-desc {
  text-align: left
}

.step-desc p {
  margin-bottom: 0
}

.steps-vertical {
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
  -ms-flex-direction: column;
  flex-direction: column
}

.step.active,
.step.current {
  color: #fff;
  background-color: #3e8ef7
}

.step.active .step-title,
.step.current .step-title {
  color: #fff
}

.step.active .step-number,
.step.current .step-number {
  color: #3e8ef7;
  background-color: #fff
}

.step.disabled {
  color: #ccd5db;
  pointer-events: none;
  cursor: auto
}

.step.disabled .step-title {
  color: #ccd5db
}

.step.disabled .step-number {
  background-color: #ccd5db
}

.step.error {
  color: #fff;
  background-color: #ff4c52
}

.step.error .step-title {
  color: #fff
}

.step.error .step-number {
  color: #ff4c52;
  background-color: #fff
}

.step.done {
  color: #fff;
  background-color: #11c26d
}

.step.done .step-title {
  color: #fff
}

.step.done .step-number {
  color: #11c26d;
  background-color: #fff
}

.steps-lg .step {
  padding: 20px 20px;
  font-size: 16px
}

.steps-lg .step-icon {
  font-size: 22px
}

.steps-lg .step-title {
  font-size: 22px
}

.steps-lg .step-number {
  width: 46px;
  height: 46px;
  font-size: 28px;
  line-height: 46px
}

.steps-lg .step-number~.step-desc {
  min-height: 46px;
  margin-left: 56px
}

.steps-sm .step {
  font-size: 12px
}

.steps-sm .step-icon {
  font-size: 18px
}

.steps-sm .step-title {
  font-size: 18px
}

.steps-sm .step-number {
  width: 30px;
  height: 30px;
  font-size: 24px;
  line-height: 30px
}

.steps-sm .step-number~.step-desc {
  min-height: 30px;
  margin-left: 40px
}

.steps-xs .step {
  font-size: 10px
}

.steps-xs .step-icon {
  font-size: 16px
}

.steps-xs .step-title {
  font-size: 16px
}

.steps-xs .step-number {
  width: 24px;
  height: 24px;
  font-size: 20px;
  line-height: 24px
}

.steps-xs .step-number~.step-desc {
  min-height: 24px;
  margin-left: 34px
}

.pearls {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-flex-wrap: wrap;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  margin: 0 0 22px
}

.pearl {
  position: relative;
  padding: 0;
  margin: 0;
  text-align: center
}

.pearl:after,
.pearl:before {
  position: absolute;
  top: 18px;
  z-index: 0;
  width: 50%;
  height: 4px;
  content: "";
  background-color: #f3f7f9
}

.pearl:before {
  left: 0
}

.pearl:after {
  right: 0
}

.pearl:first-child:before,
.pearl:last-child:after {
  display: none !important
}

.pearl-icon,
.pearl-number {
  position: relative;
  z-index: 1;
  display: inline-block;
  width: 36px;
  height: 36px;
  line-height: 32px;
  color: #fff;
  text-align: center;
  background: #ccd5db;
  border: 2px solid #ccd5db;
  border-radius: 50%
}

.pearl-number {
  font-size: 18px
}

.pearl-icon {
  font-size: 18px
}

.pearl-title {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  display: block;
  margin-top: .5em;
  margin-bottom: 0;
  font-size: 16px;
  color: #526069
}

.pearl.active:after,
.pearl.active:before,
.pearl.current:after,
.pearl.current:before {
  background-color: #3e8ef7
}

.pearl.active .pearl-icon,
.pearl.active .pearl-number,
.pearl.current .pearl-icon,
.pearl.current .pearl-number {
  color: #3e8ef7;
  background-color: #fff;
  border-color: #3e8ef7;
  -webkit-transform: scale(1.3);
  -ms-transform: scale(1.3);
  -o-transform: scale(1.3);
  transform: scale(1.3)
}

.pearl.disabled {
  pointer-events: none;
  cursor: auto
}

.pearl.disabled:after,
.pearl.disabled:before {
  background-color: #f3f7f9
}

.pearl.disabled .pearl-icon,
.pearl.disabled .pearl-number {
  color: #fff;
  background-color: #ccd5db;
  border-color: #ccd5db
}

.pearl.error:before {
  background-color: #3e8ef7
}

.pearl.error:after {
  background-color: #f3f7f9
}

.pearl.error .pearl-icon,
.pearl.error .pearl-number {
  color: #ff4c52;
  background-color: #fff;
  border-color: #ff4c52
}

.pearl.done:after,
.pearl.done:before {
  background-color: #3e8ef7
}

.pearl.done .pearl-icon,
.pearl.done .pearl-number {
  color: #fff;
  background-color: #3e8ef7;
  border-color: #3e8ef7
}

.pearls-lg .pearl:after,
.pearls-lg .pearl:before {
  top: 20px
}

.pearls-lg .pearl-title {
  font-size: 18px
}

.pearls-lg .pearl-icon,
.pearls-lg .pearl-number {
  width: 40px;
  height: 40px;
  line-height: 36px
}

.pearls-lg .pearl-icon {
  font-size: 20px
}

.pearls-lg .pearl-number {
  font-size: 20px
}

.pearls-sm .pearl:after,
.pearls-sm .pearl:before {
  top: 16px
}

.pearls-sm .pearl-title {
  font-size: 14px
}

.pearls-sm .pearl-icon,
.pearls-sm .pearl-number {
  width: 32px;
  height: 32px;
  line-height: 28px
}

.pearls-sm .pearl-number {
  font-size: 16px
}

.pearls-sm .pearl-icon {
  font-size: 14px
}

.pearls-xs .pearl:after,
.pearls-xs .pearl:before {
  top: 12px;
  height: 2px
}

.pearls-xs .pearl-title {
  font-size: 12px
}

.pearls-xs .pearl-icon,
.pearls-xs .pearl-number {
  width: 24px;
  height: 24px;
  line-height: 20px
}

.pearls-xs .pearl-number {
  font-size: 12px
}

.pearls-xs .pearl-icon {
  font-size: 12px
}

.timeline {
  position: relative;
  padding: 0;
  margin-bottom: 22px;
  list-style: none;
  background: 0 0
}

.timeline::after {
  display: block;
  clear: both;
  content: ""
}

.timeline:before {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 50%;
  width: 2px;
  margin-left: -1px;
  content: "";
  background-color: #e4eaec
}

.timeline:not(.timeline-single) .timeline-item:first-child+.timeline-item,
.timeline:not(.timeline-single) .timeline-period+.timeline-item+.timeline-item {
  margin-top: 90px
}

.timeline-item {
  position: relative;
  display: block;
  float: left;
  width: 50%;
  padding-right: 40px;
  margin-bottom: 60px
}

.timeline-item:not(.timeline-period)::after {
  display: block;
  clear: both;
  content: ""
}

.timeline-item.timeline-reverse {
  float: right;
  padding-right: 0;
  padding-left: 40px;
  clear: right
}

.timeline-item:last-child {
  margin-bottom: 0
}

.timeline-period {
  position: relative;
  z-index: 6;
  display: block;
  padding: 25px 10px;
  margin: 20px auto 30px;
  clear: both;
  font-size: 26px;
  text-align: center;
  text-transform: uppercase;
  background: #f1f4f5
}

.timeline-content {
  width: 100%;
  overflow: hidden
}

.timeline-dot {
  position: absolute;
  top: 7.5px;
  right: 0;
  z-index: 11;
  color: #fff;
  text-align: center;
  cursor: pointer;
  background-color: #3e8ef7;
  border-radius: 50%
}

.timeline-reverse .timeline-dot {
  right: auto;
  left: 0;
  margin-right: 0
}

@media (max-width:767px) {
  .timeline {
    margin-left: 7px
  }

  .timeline .timeline-dot {
    margin-left: -7px
  }
}

.timeline .timeline-dot {
  width: 14px;
  height: 14px;
  margin-right: -7px;
  line-height: 14px
}

.timeline .timeline-reverse .timeline-dot {
  margin-left: -7px
}

.timeline.timeline-single {
  margin-left: 7px
}

.timeline.timeline-single .timeline-dot {
  margin-left: -7px
}

.timeline-info {
  float: right;
  padding: 0 20px;
  margin-bottom: 22px;
  line-height: 28px;
  text-align: center;
  background: #e4eaec;
  border: 1px solid #e4eaec;
  border-radius: 20px
}

.timeline-reverse .timeline-info {
  float: left
}

.timeline-footer {
  position: absolute;
  right: 0;
  bottom: -30px;
  margin-right: 55px
}

.timeline-footer .icon {
  margin-right: .3em
}

.timeline-reverse .timeline-footer {
  right: auto;
  left: 0;
  margin-right: 0;
  margin-left: 55px
}

.timeline-reverse+.timeline-reverse {
  margin-top: 0
}

@media (max-width:767px) {
  .timeline:before {
    left: 0
  }

  .timeline-item,
  .timeline-item.timeline-reverse {
    float: none;
    width: 100%;
    padding-right: 0;
    padding-left: 40px;
    margin-top: 0;
    margin-bottom: 60px
  }

  .timeline-dot {
    right: auto;
    left: 0;
    margin-right: 0;
    margin-left: -7px
  }

  .timeline-info {
    display: inline-block;
    float: none
  }

  .timeline-footer {
    right: auto;
    bottom: -26px;
    left: 0;
    margin-right: 0;
    margin-left: 40px
  }
}

.timeline-single:before {
  left: 0
}

.timeline-single .timeline-item {
  float: none;
  width: 100%;
  padding-right: 0;
  padding-left: 40px;
  margin-bottom: 60px
}

.timeline-single .timeline-dot {
  right: auto;
  left: 0;
  margin-right: 0;
  margin-left: -7px
}

.timeline-single .timeline-info {
  float: left
}

.timeline-single .timeline-footer {
  right: auto;
  bottom: -26px;
  left: 0;
  margin-right: 0;
  margin-left: 40px
}

@media (max-width:767px) {
  .timeline-icon {
    margin-left: 20px
  }

  .timeline-icon .timeline-dot {
    margin-left: -20px
  }
}

.timeline-icon .timeline-dot {
  width: 40px;
  height: 40px;
  margin-right: -20px;
  line-height: 40px
}

.timeline-icon .timeline-reverse .timeline-dot {
  margin-left: -20px
}

.timeline-icon.timeline-single {
  margin-left: 20px
}

.timeline-icon.timeline-single .timeline-dot {
  margin-left: -20px
}

.timeline-icon .timeline-dot {
  top: -5.5px
}

@media (max-width:767px) {
  .timeline-avatar {
    margin-left: 20px
  }

  .timeline-avatar .timeline-dot {
    margin-left: -20px
  }
}

.timeline-avatar .timeline-dot {
  width: 40px;
  height: 40px;
  margin-right: -20px;
  line-height: 40px
}

.timeline-avatar .timeline-reverse .timeline-dot {
  margin-left: -20px
}

.timeline-avatar.timeline-single {
  margin-left: 20px
}

.timeline-avatar.timeline-single .timeline-dot {
  margin-left: -20px
}

@media (max-width:767px) {
  .timeline-avatar-sm {
    margin-left: 15px
  }

  .timeline-avatar-sm .timeline-dot {
    margin-left: -15px
  }
}

.timeline-avatar-sm .timeline-dot {
  width: 30px;
  height: 30px;
  margin-right: -15px;
  line-height: 30px
}

.timeline-avatar-sm .timeline-reverse .timeline-dot {
  margin-left: -15px
}

.timeline-avatar-sm.timeline-single {
  margin-left: 15px
}

.timeline-avatar-sm.timeline-single .timeline-dot {
  margin-left: -15px
}

@media (max-width:767px) {
  .timeline-avatar-lg {
    margin-left: 25px
  }

  .timeline-avatar-lg .timeline-dot {
    margin-left: -25px
  }
}

.timeline-avatar-lg .timeline-dot {
  width: 50px;
  height: 50px;
  margin-right: -25px;
  line-height: 50px
}

.timeline-avatar-lg .timeline-reverse .timeline-dot {
  margin-left: -25px
}

.timeline-avatar-lg.timeline-single {
  margin-left: 25px
}

.timeline-avatar-lg.timeline-single .timeline-dot {
  margin-left: -25px
}

.timeline-simple .timeline-dot {
  top: 0;
  margin-top: 10px
}

@media (max-width:767px) {
  .timeline-feed {
    margin-left: 15px
  }

  .timeline-feed .timeline-dot {
    margin-left: -15px
  }
}

.timeline-feed .timeline-dot {
  width: 30px;
  height: 30px;
  margin-right: -15px;
  line-height: 30px
}

.timeline-feed .timeline-reverse .timeline-dot {
  margin-left: -15px
}

.timeline-feed.timeline-single {
  margin-left: 15px
}

.timeline-feed.timeline-single .timeline-dot {
  margin-left: -15px
}

@media (max-width:767px) {
  .timeline-feed .timeline-item {
    padding-right: 30px;
    margin-bottom: 22px
  }
}

.timeline-feed.timeline-simple .timeline-dot {
  margin-top: 5px
}

.timeline-feed .timeline-item {
  padding-right: 30px;
  margin-bottom: 22px
}

.timeline-feed .timeline-item.timeline-reverse {
  padding-left: 30px
}

.timeline-feed.timeline-single .timeline-item {
  padding-left: 30px
}

.testimonial {
  margin: 3px 3px 22px
}

.testimonial-ul {
  padding: 0;
  margin: 0;
  list-style: none
}

.testimonial-item {
  float: left;
  padding: 0 15px 30px;
  margin: 0
}

.testimonial-content {
  position: relative;
  padding: 15px 20px;
  margin-top: 10px;
  margin-bottom: 25px;
  background-color: #f3f7f9;
  border-radius: .215rem
}

.testimonial-content:before {
  position: absolute;
  bottom: -7px;
  left: 33px;
  display: block;
  width: 14px;
  height: 14px;
  content: "";
  background-color: #f3f7f9;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg)
}

.testimonial-content>p:last-child {
  margin-bottom: 0
}

.testimonial-image {
  position: relative;
  float: left;
  margin-top: 5px;
  margin-left: 20px
}

.testimonial-author {
  display: block;
  margin-left: 75px;
  font-size: 18px
}

.testimonial-company {
  display: block;
  margin-left: 75px;
  font-size: .858rem;
  opacity: .8
}

.testimonial-control a {
  color: #ccd5db
}

.testimonial-control a:hover {
  color: #589ffc;
  text-decoration: none
}

.testimonial-reverse .testimonial-content:before {
  right: 33px;
  left: auto
}

.testimonial-reverse .testimonial-image {
  float: right;
  margin-right: 20px;
  margin-left: 0
}

.testimonial-reverse .testimonial-author,
.testimonial-reverse .testimonial-company {
  margin-right: 75px;
  margin-left: 0;
  text-align: right
}

.testimonial-top .testimonial-item {
  padding: 30px 15px 0
}

.testimonial-top .testimonial-content {
  margin-top: 30px;
  margin-bottom: 10px
}

.testimonial-top .testimonial-content:before {
  top: -7px;
  bottom: auto
}

.testimonial.carousel {
  position: relative;
  width: 100%;
  overflow: hidden
}

.testimonial.carousel .testimonial-item {
  position: relative;
  display: none;
  width: 100%;
  padding: 10px;
  -webkit-transition: left .6s ease-in-out 0s;
  -o-transition: left .6s ease-in-out 0s;
  transition: left .6s ease-in-out 0s
}

.testimonial.carousel .testimonial-item.active,
.testimonial.carousel .testimonial-item.next,
.testimonial.carousel .testimonial-item.prev {
  display: block
}

.testimonial.carousel .testimonial-item.next,
.testimonial.carousel .testimonial-item.prev {
  position: absolute;
  top: 0;
  width: 100%
}

.testimonial.carousel .testimonial-item.next {
  left: 100%
}

.testimonial.carousel .testimonial-item.prev {
  left: -100%
}

.testimonial.carousel .testimonial-item.next.left,
.testimonial.carousel .testimonial-item.prev.right {
  left: 0
}

.testimonial.carousel .testimonial-item.active {
  left: 0
}

.testimonial.carousel .testimonial-item.active.left {
  left: -100%
}

.testimonial.carousel .testimonial-item.active.right {
  left: 100%
}

.testimonial.carousel .testimonial-content {
  padding: 10px
}

.testimonial.carousel .testimonial-control {
  position: absolute;
  right: 10px;
  bottom: 20px
}

.testimonial.carousel .testimonial-control>* {
  margin-left: 10px
}

.testimonial.carousel.testimonial-reverse .testimonial-control {
  right: auto;
  left: 10px
}

.testimonial.carousel.testimonial-reverse .testimonial-control>* {
  margin-right: 10px;
  margin-left: 0
}

.testimonial.carousel.testimonial-top .testimonial-control {
  top: 20px;
  bottom: auto
}

.pricing-list {
  margin-bottom: 22px;
  text-align: center;
  border: 1px solid #e4eaec;
  border-radius: .215rem
}

.pricing-list [class*=bg-],
.pricing-list [class*=bg-] *,
.pricing-list [class^=bg-],
.pricing-list [class^=bg-] * {
  color: #fff
}

.pricing-list .pricing-header {
  border-bottom: 1px solid #e4eaec;
  border-radius: .215rem .215rem 0 0
}

.pricing-list .pricing-title {
  padding: 15px 30px;
  font-size: 1rem;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 2px;
  border-radius: .215rem .215rem 0 0
}

.pricing-list .pricing-price {
  padding: 20px 30px;
  margin: 0;
  font-size: 3.858rem;
  font-weight: 500;
  color: #37474f
}

.pricing-list .pricing-period {
  font-size: 1rem;
  font-weight: 300
}

.pricing-list .pricing-features {
  padding: 0 18px;
  margin: 0
}

.pricing-list .pricing-features li {
  display: block;
  padding: 15px;
  list-style: none;
  border-top: 1px dashed #e4eaec
}

.pricing-list .pricing-features li:first-child {
  border-top: none
}

.pricing-list .pricing-footer {
  padding: 30px;
  border-radius: 0 0 .215rem .215rem
}

.pricing-table {
  padding-top: 30px;
  text-align: center
}

.pricing-table::after {
  display: block;
  clear: both;
  content: ""
}

.pricing-table [class*=pricing-column] {
  float: left;
  width: 100%;
  margin-bottom: 30px;
  background-color: #f3f7f9;
  border: 1px solid #e4eaec;
  border-right: none
}

.pricing-table [class*=pricing-column]:last-child {
  border-right: 1px solid #e4eaec
}

.pricing-table [class*=pricing-column].featured {
  position: relative;
  margin-right: -1px;
  background-color: #fff;
  border-right: 1px solid #e4eaec
}

.pricing-table .pricing-header {
  padding-bottom: 24px;
  margin: 30px 30px 25px;
  border-bottom: 1px solid #e4eaec
}

.pricing-table .pricing-price {
  font-size: 48px
}

.pricing-table .pricing-currency {
  display: inline-block;
  margin-top: 10px;
  margin-right: -10px;
  font-size: 20px;
  vertical-align: top
}

.pricing-table .pricing-period {
  font-size: 16px
}

.pricing-table .pricing-title {
  font-size: 20px;
  text-transform: uppercase;
  letter-spacing: 2px
}

.pricing-table .pricing-features {
  padding: 0;
  margin: 0
}

.pricing-table .pricing-features li {
  display: block;
  margin-bottom: 20px;
  font-size: 14px;
  list-style: none
}

.pricing-table .pricing-footer {
  padding: 20px 0;
  margin: 25px 30px 30px
}

@media (min-width:768px) {
  .pricing-table .pricing-column-three {
    width: 33.33%
  }

  .pricing-table .pricing-column-three.featured {
    top: -30px;
    padding-top: 30px;
    padding-bottom: 30px;
    margin-bottom: -30px
  }

  .pricing-table .pricing-column-four {
    width: 50%
  }

  .pricing-table .pricing-column-five {
    width: 50%
  }
}

@media (min-width:1200px) {
  .pricing-table .pricing-column-four {
    width: 25%
  }

  .pricing-table .pricing-column-five {
    width: 20%
  }

  .pricing-table .pricing-column-five.featured,
  .pricing-table .pricing-column-four.featured {
    top: -30px;
    padding-top: 30px;
    padding-bottom: 30px;
    margin-bottom: -30px
  }
}

.rating {
  display: inline-block;
  margin: 0 .5rem 0 0;
  font-size: 0;
  vertical-align: middle
}

.rating:before {
  display: block;
  height: 0;
  clear: both;
  visibility: hidden;
  content: ""
}

.rating.hover .icon.active {
  opacity: .5
}

.rating .icon {
  width: 1em;
  height: auto;
  padding: 0;
  margin: 0 10px 0 0;
  font-size: 1rem;
  color: #ccd5db;
  vertical-align: middle;
  cursor: pointer
}

.rating .icon:before {
  -webkit-transition: color .3s ease, opacity .3s ease;
  -o-transition: color .3s ease, opacity .3s ease;
  transition: color .3s ease, opacity .3s ease
}

.rating .icon.active {
  color: #eb6709 !important
}

.rating .icon.active.hover {
  color: #eb6709 !important;
  opacity: 1
}

.rating .icon.hover {
  color: #eb6709 !important;
  opacity: 1
}

.rating .icon:last-child {
  margin-right: 0
}

.rating-disabled .icon {
  cursor: default
}

.rating-sm .icon {
  font-size: .858rem
}

.rating-lg .icon {
  font-size: 1.286rem
}

.ribbon {
  position: absolute;
  top: -3px;
  left: -3px;
  width: 150px;
  height: 150px;
  text-align: center;
  background-color: transparent
}

.ribbon-inner {
  position: absolute;
  top: 16px;
  left: 0;
  display: inline-block;
  max-width: 100%;
  height: 30px;
  padding-right: 20px;
  padding-left: 20px;
  overflow: hidden;
  line-height: 30px;
  color: #fff;
  text-overflow: ellipsis;
  white-space: nowrap;
  background-color: #526069
}

.ribbon-inner .icon {
  font-size: 16px
}

.ribbon-lg .ribbon-inner {
  height: 38px;
  font-size: 1.286rem;
  line-height: 38px
}

.ribbon-sm .ribbon-inner {
  height: 26px;
  font-size: .858rem;
  line-height: 26px
}

.ribbon-xs .ribbon-inner {
  height: 22px;
  font-size: .858rem;
  line-height: 22px
}

.ribbon-vertical .ribbon-inner {
  top: 0;
  left: 16px;
  width: 30px;
  height: 60px;
  padding: 15px 0
}

.ribbon-vertical.ribbon-xs .ribbon-inner {
  width: 22px;
  height: 50px
}

.ribbon-vertical.ribbon-sm .ribbon-inner {
  width: 26px;
  height: 55px
}

.ribbon-vertical.ribbon-lg .ribbon-inner {
  width: 38px;
  height: 70px
}

.ribbon-reverse {
  right: -3px;
  left: auto
}

.ribbon-reverse .ribbon-inner {
  right: 0;
  left: auto
}

.ribbon-reverse.ribbon-vertical .ribbon-inner {
  right: 16px
}

.ribbon-bookmark .ribbon-inner {
  padding-right: 42px;
  background-color: transparent;
  background-image: -webkit-linear-gradient(right, transparent 22px, #526069 0);
  background-image: -o-linear-gradient(right, transparent 22px, #526069 0);
  background-image: linear-gradient(to left, transparent 22px, #526069 0);
  -webkit-box-shadow: none;
  box-shadow: none
}

.ribbon-bookmark .ribbon-inner:before {
  position: absolute;
  top: 0;
  right: 0;
  display: block;
  width: 0;
  height: 0;
  content: "";
  border: 15px solid #526069;
  border-right: 10px solid transparent
}

.ribbon-bookmark.ribbon-vertical .ribbon-inner {
  height: 82px;
  padding-right: 0;
  padding-bottom: 37px;
  background-image: -webkit-linear-gradient(bottom, transparent 22px, #526069 0);
  background-image: -o-linear-gradient(bottom, transparent 22px, #526069 0);
  background-image: linear-gradient(to top, transparent 22px, #526069 0)
}

.ribbon-bookmark.ribbon-vertical .ribbon-inner:before {
  top: auto;
  bottom: 0;
  left: 0;
  margin-top: -15px;
  border-right: 15px solid #526069;
  border-bottom: 10px solid transparent
}

.ribbon-bookmark.ribbon-vertical.ribbon-xs .ribbon-inner:before {
  margin-top: -11px
}

.ribbon-bookmark.ribbon-vertical.ribbon-sm .ribbon-inner:before {
  margin-top: -13px
}

.ribbon-bookmark.ribbon-vertical.ribbon-lg .ribbon-inner:before {
  margin-top: -19px
}

.ribbon-bookmark.ribbon-reverse .ribbon-inner {
  padding-right: 20px;
  padding-left: 42px;
  background-image: -webkit-linear-gradient(left, transparent 22px, #526069 0);
  background-image: -o-linear-gradient(left, transparent 22px, #526069 0);
  background-image: linear-gradient(to right, transparent 22px, #526069 0)
}

.ribbon-bookmark.ribbon-reverse .ribbon-inner:before {
  left: 0;
  border-right: 15px solid #526069;
  border-left: 10px solid transparent
}

.ribbon-bookmark.ribbon-reverse.ribbon-vertical .ribbon-inner {
  padding-right: 0;
  padding-left: 0
}

.ribbon-bookmark.ribbon-reverse.ribbon-vertical .ribbon-inner:before {
  right: auto;
  left: 0;
  border-right-color: #526069;
  border-bottom-color: transparent;
  border-left: 15px solid #526069
}

.ribbon-bookmark.ribbon-xs .ribbon-inner:before {
  border-width: 11px
}

.ribbon-bookmark.ribbon-sm .ribbon-inner:before {
  border-width: 13px
}

.ribbon-bookmark.ribbon-lg .ribbon-inner:before {
  border-width: 19px
}

.ribbon-badge {
  top: -2px;
  left: -2px;
  overflow: hidden
}

.ribbon-badge .ribbon-inner {
  left: -40px;
  width: 100%;
  -webkit-transform: rotate(-45deg);
  -ms-transform: rotate(-45deg);
  -o-transform: rotate(-45deg);
  transform: rotate(-45deg)
}

.ribbon-badge.ribbon-reverse {
  right: -2px;
  left: auto
}

.ribbon-badge.ribbon-reverse .ribbon-inner {
  right: -40px;
  left: auto;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg)
}

.ribbon-badge.ribbon-bottom {
  top: auto;
  bottom: -2px
}

.ribbon-badge.ribbon-bottom .ribbon-inner {
  top: auto;
  bottom: 16px;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg)
}

.ribbon-badge.ribbon-bottom.ribbon-reverse .ribbon-inner {
  -webkit-transform: rotate(-45deg);
  -ms-transform: rotate(-45deg);
  -o-transform: rotate(-45deg);
  transform: rotate(-45deg)
}

.ribbon-corner {
  top: 0;
  left: 0;
  overflow: hidden
}

.ribbon-corner:before {
  position: absolute;
  top: 0;
  left: 0;
  width: 0;
  height: 0;
  content: "";
  border: 30px solid transparent;
  border-top-color: #526069;
  border-left-color: #526069
}

.ribbon-corner .ribbon-inner {
  top: 0;
  left: 0;
  width: 40px;
  height: 35px;
  padding: 0;
  line-height: 35px;
  background-color: transparent
}

.ribbon-corner.ribbon-reverse {
  right: 0;
  left: auto
}

.ribbon-corner.ribbon-reverse:before {
  right: 0;
  left: auto;
  border-right-color: #526069;
  border-left-color: transparent
}

.ribbon-corner.ribbon-reverse .ribbon-inner {
  right: 0;
  left: auto
}

.ribbon-corner.ribbon-bottom {
  top: auto;
  bottom: 0
}

.ribbon-corner.ribbon-bottom:before {
  top: auto;
  bottom: 0;
  border-top-color: transparent;
  border-bottom-color: #526069
}

.ribbon-corner.ribbon-bottom .ribbon-inner {
  top: auto;
  bottom: 0
}

.ribbon-corner.ribbon-xs:before {
  border-width: 22px
}

.ribbon-corner.ribbon-xs .ribbon-inner {
  width: 28px;
  height: 26px;
  line-height: 26px
}

.ribbon-corner.ribbon-xs .ribbon-inner>.icon {
  font-size: .858rem
}

.ribbon-corner.ribbon-sm:before {
  border-width: 26px
}

.ribbon-corner.ribbon-sm .ribbon-inner {
  width: 34px;
  height: 32px;
  line-height: 32px
}

.ribbon-corner.ribbon-sm .ribbon-inner>.icon {
  font-size: .858rem
}

.ribbon-corner.ribbon-lg:before {
  border-width: 36px
}

.ribbon-corner.ribbon-lg .ribbon-inner {
  width: 46px;
  height: 44px;
  line-height: 44px
}

.ribbon-corner.ribbon-lg .ribbon-inner>.icon {
  font-size: 1.286rem
}

.ribbon-clip {
  left: -14px
}

.ribbon-clip:before {
  position: absolute;
  top: 46px;
  left: 0;
  width: 0;
  height: 0;
  content: "";
  border: 7px solid transparent;
  border-top-color: #37474f;
  border-right-color: #37474f
}

.ribbon-clip .ribbon-inner {
  padding-left: 23px;
  border-radius: 0 5px 5px 0
}

.ribbon-clip.ribbon-reverse {
  right: -14px;
  left: auto
}

.ribbon-clip.ribbon-reverse:before {
  right: 0;
  left: auto;
  border-right-color: transparent;
  border-left-color: #37474f
}

.ribbon-clip.ribbon-reverse .ribbon-inner {
  padding-right: 23px;
  padding-left: 15px;
  border-radius: 5px 0 0 5px
}

.ribbon-clip.ribbon-bottom {
  top: auto;
  bottom: -3px
}

.ribbon-clip.ribbon-bottom:before {
  top: auto;
  bottom: 46px;
  border-top-color: transparent;
  border-bottom-color: #37474f
}

.ribbon-clip.ribbon-bottom .ribbon-inner {
  top: auto;
  bottom: 16px
}

.ribbon-clip.ribbon-xs:before {
  top: 38px
}

.ribbon-clip.ribbon-xs.ribbon-bottom:before {
  top: auto;
  bottom: 38px
}

.ribbon-clip.ribbon-sm:before {
  top: 42px
}

.ribbon-clip.ribbon-sm.ribbon-bottom:before {
  top: auto;
  bottom: 42px
}

.ribbon-clip.ribbon-lg:before {
  top: 54px
}

.ribbon-clip.ribbon-lg.ribbon-bottom:before {
  top: auto;
  bottom: 54px
}

.ribbon-primary .ribbon-inner {
  background-color: #3e8ef7
}

.ribbon-primary.ribbon-bookmark .ribbon-inner {
  background-color: transparent;
  background-image: -webkit-linear-gradient(right, transparent 22px, #3e8ef7 0);
  background-image: -o-linear-gradient(right, transparent 22px, #3e8ef7 0);
  background-image: linear-gradient(to left, transparent 22px, #3e8ef7 0)
}

.ribbon-primary.ribbon-bookmark .ribbon-inner:before {
  border-color: #3e8ef7;
  border-right-color: transparent
}

.ribbon-primary.ribbon-bookmark.ribbon-reverse .ribbon-inner {
  background-image: -webkit-linear-gradient(left, transparent 22px, #3e8ef7 0);
  background-image: -o-linear-gradient(left, transparent 22px, #3e8ef7 0);
  background-image: linear-gradient(to right, transparent 22px, #3e8ef7 0)
}

.ribbon-primary.ribbon-bookmark.ribbon-reverse .ribbon-inner:before {
  border-right-color: #3e8ef7;
  border-left-color: transparent
}

.ribbon-primary.ribbon-bookmark.ribbon-vertical .ribbon-inner {
  background-image: -webkit-linear-gradient(bottom, transparent 22px, #3e8ef7 0);
  background-image: -o-linear-gradient(bottom, transparent 22px, #3e8ef7 0);
  background-image: linear-gradient(to top, transparent 22px, #3e8ef7 0)
}

.ribbon-primary.ribbon-bookmark.ribbon-vertical .ribbon-inner:before {
  border-right-color: #3e8ef7;
  border-bottom-color: transparent
}

.ribbon-primary.ribbon-bookmark.ribbon-vertical.ribbon-reverse .ribbon-inner:before {
  border-right-color: #3e8ef7;
  border-bottom-color: transparent;
  border-left-color: #3e8ef7
}

.ribbon-primary.ribbon-corner:before {
  border-top-color: #3e8ef7;
  border-left-color: #3e8ef7
}

.ribbon-primary.ribbon-corner .ribbon-inner {
  background-color: transparent
}

.ribbon-primary.ribbon-corner.ribbon-reverse:before {
  border-right-color: #3e8ef7;
  border-left-color: transparent
}

.ribbon-primary.ribbon-corner.ribbon-bottom:before {
  border-top-color: transparent;
  border-bottom-color: #3e8ef7
}

.ribbon-primary.ribbon-clip:before {
  border-top-color: #247cf0;
  border-right-color: #247cf0
}

.ribbon-primary.ribbon-clip.ribbon-reverse:before {
  border-right-color: transparent;
  border-left-color: #247cf0
}

.ribbon-primary.ribbon-clip.ribbon-bottom:before {
  border-top-color: transparent;
  border-bottom-color: #247cf0
}

.ribbon-success .ribbon-inner {
  background-color: #11c26d
}

.ribbon-success.ribbon-bookmark .ribbon-inner {
  background-color: transparent;
  background-image: -webkit-linear-gradient(right, transparent 22px, #11c26d 0);
  background-image: -o-linear-gradient(right, transparent 22px, #11c26d 0);
  background-image: linear-gradient(to left, transparent 22px, #11c26d 0)
}

.ribbon-success.ribbon-bookmark .ribbon-inner:before {
  border-color: #11c26d;
  border-right-color: transparent
}

.ribbon-success.ribbon-bookmark.ribbon-reverse .ribbon-inner {
  background-image: -webkit-linear-gradient(left, transparent 22px, #11c26d 0);
  background-image: -o-linear-gradient(left, transparent 22px, #11c26d 0);
  background-image: linear-gradient(to right, transparent 22px, #11c26d 0)
}

.ribbon-success.ribbon-bookmark.ribbon-reverse .ribbon-inner:before {
  border-right-color: #11c26d;
  border-left-color: transparent
}

.ribbon-success.ribbon-bookmark.ribbon-vertical .ribbon-inner {
  background-image: -webkit-linear-gradient(bottom, transparent 22px, #11c26d 0);
  background-image: -o-linear-gradient(bottom, transparent 22px, #11c26d 0);
  background-image: linear-gradient(to top, transparent 22px, #11c26d 0)
}

.ribbon-success.ribbon-bookmark.ribbon-vertical .ribbon-inner:before {
  border-right-color: #11c26d;
  border-bottom-color: transparent
}

.ribbon-success.ribbon-bookmark.ribbon-vertical.ribbon-reverse .ribbon-inner:before {
  border-right-color: #11c26d;
  border-bottom-color: transparent;
  border-left-color: #11c26d
}

.ribbon-success.ribbon-corner:before {
  border-top-color: #11c26d;
  border-left-color: #11c26d
}

.ribbon-success.ribbon-corner .ribbon-inner {
  background-color: transparent
}

.ribbon-success.ribbon-corner.ribbon-reverse:before {
  border-right-color: #11c26d;
  border-left-color: transparent
}

.ribbon-success.ribbon-corner.ribbon-bottom:before {
  border-top-color: transparent;
  border-bottom-color: #11c26d
}

.ribbon-success.ribbon-clip:before {
  border-top-color: #05a85c;
  border-right-color: #05a85c
}

.ribbon-success.ribbon-clip.ribbon-reverse:before {
  border-right-color: transparent;
  border-left-color: #05a85c
}

.ribbon-success.ribbon-clip.ribbon-bottom:before {
  border-top-color: transparent;
  border-bottom-color: #05a85c
}

.ribbon-info .ribbon-inner {
  background-color: #0bb2d4
}

.ribbon-info.ribbon-bookmark .ribbon-inner {
  background-color: transparent;
  background-image: -webkit-linear-gradient(right, transparent 22px, #0bb2d4 0);
  background-image: -o-linear-gradient(right, transparent 22px, #0bb2d4 0);
  background-image: linear-gradient(to left, transparent 22px, #0bb2d4 0)
}

.ribbon-info.ribbon-bookmark .ribbon-inner:before {
  border-color: #0bb2d4;
  border-right-color: transparent
}

.ribbon-info.ribbon-bookmark.ribbon-reverse .ribbon-inner {
  background-image: -webkit-linear-gradient(left, transparent 22px, #0bb2d4 0);
  background-image: -o-linear-gradient(left, transparent 22px, #0bb2d4 0);
  background-image: linear-gradient(to right, transparent 22px, #0bb2d4 0)
}

.ribbon-info.ribbon-bookmark.ribbon-reverse .ribbon-inner:before {
  border-right-color: #0bb2d4;
  border-left-color: transparent
}

.ribbon-info.ribbon-bookmark.ribbon-vertical .ribbon-inner {
  background-image: -webkit-linear-gradient(bottom, transparent 22px, #0bb2d4 0);
  background-image: -o-linear-gradient(bottom, transparent 22px, #0bb2d4 0);
  background-image: linear-gradient(to top, transparent 22px, #0bb2d4 0)
}

.ribbon-info.ribbon-bookmark.ribbon-vertical .ribbon-inner:before {
  border-right-color: #0bb2d4;
  border-bottom-color: transparent
}

.ribbon-info.ribbon-bookmark.ribbon-vertical.ribbon-reverse .ribbon-inner:before {
  border-right-color: #0bb2d4;
  border-bottom-color: transparent;
  border-left-color: #0bb2d4
}

.ribbon-info.ribbon-corner:before {
  border-top-color: #0bb2d4;
  border-left-color: #0bb2d4
}

.ribbon-info.ribbon-corner .ribbon-inner {
  background-color: transparent
}

.ribbon-info.ribbon-corner.ribbon-reverse:before {
  border-right-color: #0bb2d4;
  border-left-color: transparent
}

.ribbon-info.ribbon-corner.ribbon-bottom:before {
  border-top-color: transparent;
  border-bottom-color: #0bb2d4
}

.ribbon-info.ribbon-clip:before {
  border-top-color: #0099b8;
  border-right-color: #0099b8
}

.ribbon-info.ribbon-clip.ribbon-reverse:before {
  border-right-color: transparent;
  border-left-color: #0099b8
}

.ribbon-info.ribbon-clip.ribbon-bottom:before {
  border-top-color: transparent;
  border-bottom-color: #0099b8
}

.ribbon-warning .ribbon-inner {
  background-color: #eb6709
}

.ribbon-warning.ribbon-bookmark .ribbon-inner {
  background-color: transparent;
  background-image: -webkit-linear-gradient(right, transparent 22px, #eb6709 0);
  background-image: -o-linear-gradient(right, transparent 22px, #eb6709 0);
  background-image: linear-gradient(to left, transparent 22px, #eb6709 0)
}

.ribbon-warning.ribbon-bookmark .ribbon-inner:before {
  border-color: #eb6709;
  border-right-color: transparent
}

.ribbon-warning.ribbon-bookmark.ribbon-reverse .ribbon-inner {
  background-image: -webkit-linear-gradient(left, transparent 22px, #eb6709 0);
  background-image: -o-linear-gradient(left, transparent 22px, #eb6709 0);
  background-image: linear-gradient(to right, transparent 22px, #eb6709 0)
}

.ribbon-warning.ribbon-bookmark.ribbon-reverse .ribbon-inner:before {
  border-right-color: #eb6709;
  border-left-color: transparent
}

.ribbon-warning.ribbon-bookmark.ribbon-vertical .ribbon-inner {
  background-image: -webkit-linear-gradient(bottom, transparent 22px, #eb6709 0);
  background-image: -o-linear-gradient(bottom, transparent 22px, #eb6709 0);
  background-image: linear-gradient(to top, transparent 22px, #eb6709 0)
}

.ribbon-warning.ribbon-bookmark.ribbon-vertical .ribbon-inner:before {
  border-right-color: #eb6709;
  border-bottom-color: transparent
}

.ribbon-warning.ribbon-bookmark.ribbon-vertical.ribbon-reverse .ribbon-inner:before {
  border-right-color: #eb6709;
  border-bottom-color: transparent;
  border-left-color: #eb6709
}

.ribbon-warning.ribbon-corner:before {
  border-top-color: #eb6709;
  border-left-color: #eb6709
}

.ribbon-warning.ribbon-corner .ribbon-inner {
  background-color: transparent
}

.ribbon-warning.ribbon-corner.ribbon-reverse:before {
  border-right-color: #eb6709;
  border-left-color: transparent
}

.ribbon-warning.ribbon-corner.ribbon-bottom:before {
  border-top-color: transparent;
  border-bottom-color: #eb6709
}

.ribbon-warning.ribbon-clip:before {
  border-top-color: #de4e00;
  border-right-color: #de4e00
}

.ribbon-warning.ribbon-clip.ribbon-reverse:before {
  border-right-color: transparent;
  border-left-color: #de4e00
}

.ribbon-warning.ribbon-clip.ribbon-bottom:before {
  border-top-color: transparent;
  border-bottom-color: #de4e00
}

.ribbon-danger .ribbon-inner {
  background-color: #ff4c52
}

.ribbon-danger.ribbon-bookmark .ribbon-inner {
  background-color: transparent;
  background-image: -webkit-linear-gradient(right, transparent 22px, #ff4c52 0);
  background-image: -o-linear-gradient(right, transparent 22px, #ff4c52 0);
  background-image: linear-gradient(to left, transparent 22px, #ff4c52 0)
}

.ribbon-danger.ribbon-bookmark .ribbon-inner:before {
  border-color: #ff4c52;
  border-right-color: transparent
}

.ribbon-danger.ribbon-bookmark.ribbon-reverse .ribbon-inner {
  background-image: -webkit-linear-gradient(left, transparent 22px, #ff4c52 0);
  background-image: -o-linear-gradient(left, transparent 22px, #ff4c52 0);
  background-image: linear-gradient(to right, transparent 22px, #ff4c52 0)
}

.ribbon-danger.ribbon-bookmark.ribbon-reverse .ribbon-inner:before {
  border-right-color: #ff4c52;
  border-left-color: transparent
}

.ribbon-danger.ribbon-bookmark.ribbon-vertical .ribbon-inner {
  background-image: -webkit-linear-gradient(bottom, transparent 22px, #ff4c52 0);
  background-image: -o-linear-gradient(bottom, transparent 22px, #ff4c52 0);
  background-image: linear-gradient(to top, transparent 22px, #ff4c52 0)
}

.ribbon-danger.ribbon-bookmark.ribbon-vertical .ribbon-inner:before {
  border-right-color: #ff4c52;
  border-bottom-color: transparent
}

.ribbon-danger.ribbon-bookmark.ribbon-vertical.ribbon-reverse .ribbon-inner:before {
  border-right-color: #ff4c52;
  border-bottom-color: transparent;
  border-left-color: #ff4c52
}

.ribbon-danger.ribbon-corner:before {
  border-top-color: #ff4c52;
  border-left-color: #ff4c52
}

.ribbon-danger.ribbon-corner .ribbon-inner {
  background-color: transparent
}

.ribbon-danger.ribbon-corner.ribbon-reverse:before {
  border-right-color: #ff4c52;
  border-left-color: transparent
}

.ribbon-danger.ribbon-corner.ribbon-bottom:before {
  border-top-color: transparent;
  border-bottom-color: #ff4c52
}

.ribbon-danger.ribbon-clip:before {
  border-top-color: #f2353c;
  border-right-color: #f2353c
}

.ribbon-danger.ribbon-clip.ribbon-reverse:before {
  border-right-color: transparent;
  border-left-color: #f2353c
}

.ribbon-danger.ribbon-clip.ribbon-bottom:before {
  border-top-color: transparent;
  border-bottom-color: #f2353c
}

.color-selector {
  padding: 0;
  margin: 0;
  list-style: none
}

.color-selector>li {
  position: relative;
  display: inline-block;
  width: 30px;
  height: 30px;
  margin: 0 8px 8px 0;
  background-color: #3e8ef7;
  border-radius: 100%
}

.color-selector>li:hover {
  opacity: .8
}

.color-selector>li:before {
  position: absolute;
  top: 0;
  left: 0;
  display: inline-block;
  width: inherit;
  height: inherit;
  content: "";
  background: inherit;
  border: 1px solid rgba(0, 0, 0, .1);
  border-radius: inherit
}

.color-selector>li input[type=radio] {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1;
  width: inherit;
  height: inherit;
  cursor: pointer;
  border-radius: inherit;
  opacity: 0
}

.color-selector>li input[type=radio]:disabled {
  cursor: not-allowed
}

.color-selector>li label {
  position: relative;
  margin-bottom: .4rem;
  font-family: "Web Icons";
  font-style: normal;
  font-weight: 400;
  font-variant: normal;
  text-transform: none
}

.color-selector>li input[type=radio]:checked+label:after {
  position: absolute;
  top: 0;
  left: 8px;
  display: inline-block;
  margin-top: -2px;
  font-size: 16px;
  line-height: 1;
  color: #fff;
  content: ""
}

.color-selector>li.color-selector-disabled {
  background-color: #e4eaec !important
}

.color-selector>li.color-selector-disabled input[type=radio]:disabled {
  cursor: not-allowed
}

.example-wrap {
  margin-bottom: 80px
}

.example-wrap .example-wrap {
  margin-bottom: 0
}

.example {
  margin-top: 20px;
  margin-bottom: 20px
}

.example::after {
  display: block;
  clear: both;
  content: ""
}

.example:before {
  display: table;
  content: ""
}

.example-title {
  text-transform: uppercase
}

h4.example-title {
  font-size: 14px
}

h3.example-title {
  font-size: 18px
}

.panel-body>.example-wrap:last-child {
  margin-bottom: 0
}

.panel-body>.row:last-child>[class*=col-]:last-child .example-wrap:last-child {
  margin-bottom: 0
}

.example-well {
  position: relative;
  margin-bottom: 30px;
  background-color: #f1f4f5
}

.example-well .center {
  position: absolute;
  top: 50%;
  left: 50%;
  display: inline-block;
  max-width: 100%;
  max-height: 100%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  -o-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%)
}

.example-dropdown .dropdown::after,
.example-dropdown .dropup::after {
  display: block;
  clear: both;
  content: ""
}

.example-dropdown .dropdown>.dropdown-toggle,
.example-dropdown .dropup>.dropdown-toggle {
  float: left
}

.example-dropdown .dropdown>.dropdown-menu,
.example-dropdown .dropup>.dropdown-menu {
  position: static;
  display: block;
  clear: left
}

.example-dropdown .dropdown>.dropdown-menu-right,
.example-dropdown .dropup>.dropdown-menu-right {
  float: right;
  clear: right
}

.example-tooltip {
  position: relative;
  z-index: 1;
  display: inline-block
}

.example-tooltip .tooltip {
  position: relative;
  margin-right: 25px;
  opacity: 1
}

.example-tooltip .tooltip.bs-tooltip-bottom .arrow,
.example-tooltip .tooltip.bs-tooltip-top .arrow {
  left: 50%
}

.example-tooltip .tooltip.bs-tooltip-bottom .arrow {
  top: 0
}

.example-tooltip .tooltip.bs-tooltip-top .arrow {
  bottom: 0
}

.example-tooltip .tooltip.bs-tooltip-left .arrow,
.example-tooltip .tooltip.bs-tooltip-right .arrow {
  top: 50%
}

.example-tooltip .tooltip.bs-tooltip-left .arrow {
  right: 0
}

.example-tooltip .tooltip.bs-tooltip-right .arrow {
  left: 0
}

.example-blocks .example-col,
.example-grid .example-col {
  min-height: 0;
  padding: 10px 15px 12px;
  background-color: #f1f4f5;
  border-radius: 0
}

.example-grid .example-col {
  margin-bottom: 20px
}

.example-grid .example-col .example-col {
  margin-top: 20px;
  margin-bottom: 0;
  background-color: #e2e8ea
}

.example-popover {
  position: relative;
  z-index: 1;
  display: inline-block
}

.example-popover .popover {
  position: relative;
  display: block;
  margin-right: 25px
}

.example-buttons .btn,
.example-buttons .btn-group,
.example-buttons .btn-group-vertical {
  margin-right: 15px;
  margin-bottom: 20px
}

.example-buttons .btn-group .btn,
.example-buttons .btn-group .btn-group,
.example-buttons .btn-group .btn-group-vertical,
.example-buttons .btn-group-vertical .btn,
.example-buttons .btn-group-vertical .btn-group,
.example-buttons .btn-group-vertical .btn-group-vertical {
  margin-right: 0;
  margin-bottom: 0
}

.example-box {
  position: relative;
  padding: 45px 15px 15px;
  margin-right: 0;
  margin-left: 0;
  border: 1px solid #e4eaec
}

.example-box:after {
  position: absolute;
  top: 15px;
  left: 15px;
  font-size: .858rem;
  color: #959595;
  text-transform: uppercase;
  letter-spacing: 1px;
  content: "Example"
}

.example-avatars .avatar {
  margin-right: 20px;
  margin-bottom: 20px
}

.example-avatars .avatar:last-child {
  margin-right: 20px
}

.example-typography {
  position: relative;
  padding-left: 25%
}

.example-typography .heading-note,
.example-typography .text-note {
  position: absolute;
  bottom: 2px;
  left: 0;
  display: block;
  width: 260px;
  font-size: 13px;
  font-weight: 300;
  line-height: 13px;
  color: #aab2bd
}

.example-typography .text-note {
  top: 10px;
  bottom: auto
}

.example-responsive {
  min-height: .01%;
  overflow-x: auto
}

@media (max-width:767px) {
  .example-responsive {
    width: 100%;
    overflow-y: hidden;
    -ms-overflow-style: -ms-autohiding-scrollbar
  }
}
</style>
<div class="page">
    <div class="page-content container-fluid">
      <div class="example-wrap">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="card">
              <div class="card-block pt-4 pl-4 pb-0">
                <h3 class="" style="color:#232e74;font-weight: 600;padding-left: 40px;">Request Details</h4>
              </div>
              <div class="example-wrap">
                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <!-- Example Standard Card -->
                    <div class="res_card">
                      <div class="card-body">
                        <div class="card-title c_p_11 d-flex justify-content-between">
                          <div><b>Basic Details</b></div>
                        </div>
                        <div class="card-text">
                          <table style="margin: 15px 0px;">
                            <tr>
                              <td style="padding-right: 3px;"><b>Patient Name</b></td>
                              <td style="padding-right: 3px;">:</td>
                              <td>{{ ucwords($request_details->patient_name) }}</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 3px;"><b>Patient UId</b></td>
                              <td style="padding-right: 3px;">:</td>
                              <td>{{ ucwords($request_details->unique_id) }}</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 3px;"><b>Condition</b></td>
                              <td style="padding-right: 3px;">:</td>
                              <td>{{ $request_details->comments }}</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 3px;"><b>Email</b></td>
                              <td style="padding-right: 3px;">:</td>
                              <td>{{ $request_details->email }}</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 3px;"><b>Age</b></td>
                              <td style="padding-right: 3px;">:</td>
                              <td>{{ $request_details->patient_age }}</td>
                            </tr>
                            <tr>
                              <td style="padding-right: 3px;"><b>Address</b></td>
                              <td style="padding-right: 3px;">:</td>
                              <td>{{ $request_details->address }}</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <!-- Example Card Image overlays -->
                    <div class="res_card">
                      <div class="card-body">
                        <div class="card-title c_p_11 d-flex justify-content-between">
                          <div><b>Medical History</b></div>
                        </div>
                        <div class="card-text">
                          <table border="1" cellpadding="0" cellspacing="0" style="margin: 15px 0px;">
                            <tr>
                              <th class="td_class"><strong>Medication</strong></th>
                              <th class="td_class"><strong>Diagnosis</strong></th>
                              <th class="td_class"><strong>Timings</strong></th>
                              <th class="td_class"><strong>Start Date</strong></th>
                            </tr>
                            @if(count($request_medications)>0)
                              @foreach($request_medications as $request_med)
                                <tr>
                                  <td class="td_class">{{ $request_med->medication_name }}</td>
                                  <td class="td_class">{{ $request_med->diagnosis }}</td>
                                  <td class="td_class">{{ ucwords(str_replace(',',', ',$request_med->frequency)) }}</td>
                                  <td class="td_class">{{ date('d/m/Y', strtotime($request_med->start_date)) }}</td>
                                </tr>
                              @endforeach
                            @else
                              <tr><td colspan="4"><strong>No Medication found</strong></td></tr>
                            @endif
                          </table>
                        </div>
                      </div>
                    </div>
                    <!-- End Example Card Image overlays -->
                  </div>
                </div>
                </div>
                <div class="row mt-4">
                  <div class="col-lg-6 col-md-6">
                    <!-- Example Standard Card -->
                    <div class="res_card" style="">
                      <div class="card-body">
                        <div class="card-title c_p_11 d-flex justify-content-between">
                          <div><b>Allergies</b></div>
                        </div>
                        <div class="card-text mt-2">
                          @if(count($request_allergies)>0)
                            @foreach($request_allergies as $request_allergy)
                            <h5 class="mb-1 text-left mt-0"><b>{{ $request_allergy->allergy_name }}</b></h5>
                            <p>{{ $request_allergy->allergy_description }}</p>
                            @endforeach
                          @else
                            <div style="text-align:center;"><h4>No allergies found</h4></div>
                          @endif                        
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <!-- Example Card Image overlays -->
                    <div class="res_card" style="">
                      <div class="card-body">
                        <div class="card-title c_p_11 d-flex justify-content-between">
                          <div><b>Medical Conditions</b></div>
                        </div>
                        <div class="card-text mt-2">
                          @if(count($request_medical_conditions)>0)
                            @foreach($request_medical_conditions as $request_medical_cond)
                            <h5 class="mb-1 text-left mt-0"><b>{{ $request_medical_cond->request_medical_condition }}</b></h5>
                            <p>{{ $request_medical_cond->request_med_decription }}</p>
                            @endforeach
                          @else
                            <div style="text-align:center;"><h4>No allergies found</h4></div>
                          @endif    
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Example Card Image overlays -->
                </div>
              </div>
            </div>
            <br>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>