import React, { useState } from "react";
import styles from "./styles.module.css";
import { Title } from "../../components/atoms/Title";

export const Login: React.FC = () => {
  return (
    <div className={styles.authBaseLayout}>
      <div className={styles.authContainer}>
        <div className={styles.title}>
          <Title title="Chat App" />
        </div>
        <div className={styles.authTitle}>Login</div>
        <a href="/login" className={styles.link}>
          Sign Up
        </a>
        <form action="">
          <div className={styles.inputBox}>
            <label htmlFor="">Email</label>
            <input type="text" />
          </div>
          <div className={styles.inputBox}>
            <label htmlFor="">Password</label>
            <input type="text" />
          </div>
          <div className={styles.submitButton}>
            <button type="submit">Login</button>
          </div>
        </form>
      </div>
    </div>
  );
};
