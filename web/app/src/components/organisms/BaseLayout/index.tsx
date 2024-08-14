import React from "react";
import styles from "./styles.module.css";
import { SideBar } from "../sidebar";

type BaseLayoutProps = {
  children?: React.ReactNode;
};

export const BaseLayout: React.FC<BaseLayoutProps> = ({ children }) => {
  return (
    <div className={styles.base}>
      <SideBar />
      {children}
    </div>
  );
};
