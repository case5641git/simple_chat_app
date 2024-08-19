import React from "react";
import styles from "./styles.module.css";

type ModalBaseProps = {
  children: React.ReactNode;
};

export const ModalBase: React.FC<ModalBaseProps> = ({ children }) => {
  return (
    <div className={styles.overlay}>
      <div className={styles.content}>{children}</div>
    </div>
  );
};
