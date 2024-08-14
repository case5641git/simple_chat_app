import React from "react";
import styles from "./styles.module.css";

export const ChatArea: React.FC = () => {
  return (
    <section className={styles.chatAreaWrapper}>
      <div className={styles.chatAreaInner}>
        <div className={styles.chatAreaNotice}>
          <p>Please Select Channel or Chat...</p>
        </div>
      </div>
    </section>
  );
};
