import React from "react";
import styles from "./styles.module.css";
import logout_btn from "../../../images/logout_btn.png";
import profile_image_dummy from "../../../images/profile_image_dummy.png";
import { MenuList } from "../../molecules/MenuList";
import { Title } from "../../atoms/Title";
import { SearchBox } from "../../molecules/SearchBox";

export const SideBar: React.FC = () => {
  return (
    <section className={styles.sidebar}>
      <Title title="ChatAPP" />
      <SearchBox type="text" placeholder="Search" />
      <div className={styles.menu}>
        <div className={styles.menuName}>Channel</div>
        <MenuList />
      </div>
      <div className={styles.links}>
        <div className={styles.link}>
          <img src={profile_image_dummy} alt="プロフィール画像" />
          <span>Profile</span>
        </div>
        <div className={styles.link}>
          <img src={logout_btn} alt="ログアウト" />
          <span>logout</span>
        </div>
      </div>
    </section>
  );
};
