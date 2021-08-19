import {FaFacebook, FaSearch, FaAlignJustify, FaFacebookMessenger, FaCaretDown } from "react-icons/fa";
import { IoNotificationsSharp } from "react-icons/io5";

export default function(){
    return (
        <div className="header">
        <div className="headerLeft">
          <div className="logo-fb">
            <FaFacebook />
          </div>
          <div className="search-fb">
            <FaSearch />
          </div>
          <div className="menu-fb">
            <FaAlignJustify />
          </div>
        </div>
        <div className="headerRight">
          <div className="plus-btn">
              +
          </div>
          <div className="messenger-btn">
              <FaFacebookMessenger />
          </div>
          <div className="notification-btn">
              <IoNotificationsSharp />
          </div>
          <div className="caretdown-btn">
              <FaCaretDown />
          </div>
        </div>
      </div>
    );
}