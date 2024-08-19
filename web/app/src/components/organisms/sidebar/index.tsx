import React, { useState } from "react";
import styles from "./styles.module.css";
import logout_btn from "../../../images/logout_btn.png";
import profile_image_dummy from "../../../images/profile_image_dummy.png";
import { MenuList } from "../../molecules/MenuList";
import { Title } from "../../atoms/Title";
import { SearchBox } from "../../molecules/SearchBox";
import { SectionTitle } from "../../molecules/SectionTitle";
import create_btn from "../../../images/create_btn.png";

type SideBarProps = {
  onChangeId: (newChannelId: number) => void;
  onClick?: () => void;
};

export const SideBar: React.FC<SideBarProps> = ({ onChangeId, onClick }) => {
  const [showModalContent, setShowModalContent] =
    useState<React.ReactNode | null>(null);

  const handleToggleModal = (modalContent: React.ReactNode) => {
    setShowModalContent(showModalContent);
  };

  return (
    <section className={styles.sidebar}>
      <Title title="ChatAPP" />
      <SearchBox type="text" placeholder="Search" />
      <div className={styles.menu}>
        <SectionTitle title="Channels" image={create_btn} />
        <MenuList onClick={onClick} onChangeId={onChangeId} />
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
