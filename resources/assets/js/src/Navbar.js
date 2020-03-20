import React from "react";
import Axios from "axios";

async function logOut() {
  const { data } = await Axios.post("/business/logout");

  if (data.status === true) {
    window.location.href = "/yonetim/giris";
  }
}

const Navbar = props => {
  return (
    <div>
      <nav className="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div className="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center"></div>
        <div className="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <button
            className="navbar-toggler navbar-toggler align-self-center"
            type="button"
            data-toggle="minimize"
          >
            <span className="icon-menu"></span>
          </button>
          <ul className="navbar-nav mr-lg-2"></ul>
          <ul className="navbar-nav navbar-nav-right">
            <li className="nav-item dropdown d-flex mr-4 ">
              <a
                className="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
                id="notificationDropdown"
                href="#"
                data-toggle="dropdown"
              >
                <i className="icon-cog"></i>
              </a>
              <div
                className="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                aria-labelledby="notificationDropdown"
              >
                <p className="mb-0 font-weight-normal float-left dropdown-header">
                  Ayarlar
                </p>
                <button className="dropdown-item preview-item" onClick={logOut}>
                  <i className="icon-inbox"></i>
                  Çıkış Yap
                </button>
              </div>
            </li>
          </ul>
          <button
            className="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
            type="button"
            data-toggle="offcanvas"
          >
            <span className="icon-menu"></span>
          </button>
        </div>
      </nav>
    </div>
  );
};

export default Navbar;
