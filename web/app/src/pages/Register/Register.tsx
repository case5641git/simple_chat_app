import React, { useState } from "react";
import styles from "./styles.module.css";
import { Title } from "../../components/atoms/Title";

export const Register: React.FC = () => {
  return (
    <div className={styles.authBaseLayout}>
      <div className={styles.authContainer}>
        <div className={styles.title}>
          <Title title="Chat App" />
        </div>
        <div className={styles.authTitle}>Sing Up</div>
        <a href="/login" className={styles.link}>
          Login
        </a>
        <form action="">
          <div className={styles.inputBox}>
            <label htmlFor="">Name</label>
            <input type="text" />
          </div>
          <div className={styles.inputBox}>
            <label htmlFor="">Email</label>
            <input type="text" />
          </div>
          <div className={styles.inputBox}>
            <label htmlFor="">Password</label>
            <input type="text" />
          </div>
          <div className={styles.inputBox}>
            <label htmlFor="">Confirm Password</label>
            <input type="text" />
          </div>
          <div className={styles.submitButton}>
            <button type="submit">Join in</button>
          </div>
        </form>
      </div>
    </div>
  );
};
