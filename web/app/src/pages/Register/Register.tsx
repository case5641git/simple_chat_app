import React, { useState } from "react";
import styles from "./styles.module.css";
import { Title } from "../../components/atoms/Title";
import axios from "axios";
import { useNavigate } from "react-router-dom";

export const Register: React.FC = () => {
  const [name, setName] = useState<string>("");
  const [email, setEmail] = useState<string>("");
  const [password, setPassword] = useState<string>("");
  const [confirmPassword, setConfirmPassword] = useState<string>("");
  const navigate = useNavigate();
  const [error, setError] = useState<string | null>(null);

  const url = "http://localhost:8000/api/register";

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    if (password !== confirmPassword) {
      console.log("パスワードが一致しません");
      return;
    }

    try {
      const response = await axios.post(url, {
        name: name,
        email: email,
        password: password,
      });
      console.log(response);
      navigate("/");
    } catch (error) {
      console.log(error);
      setError("アカウントを作成できませんでした。");
    }
  };

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
        <form onSubmit={handleSubmit}>
          <div className={styles.inputBox}>
            <label htmlFor="">Name</label>
            <input
              type="text"
              name="name"
              value={name}
              onChange={(e) => setName(e.target.value)}
            />
          </div>
          <div className={styles.inputBox}>
            <label htmlFor="">Email</label>
            <input
              type="text"
              name="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
            />
          </div>
          <div className={styles.inputBox}>
            <label htmlFor="">Password</label>
            <input
              type="text"
              name="password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
            />
          </div>
          <div className={styles.inputBox}>
            <label htmlFor="">Confirm Password</label>
            <input
              type="text"
              name="confirmPassword"
              value={confirmPassword}
              onChange={(e) => setConfirmPassword(e.target.value)}
            />
          </div>
          <div className={styles.submitButton}>
            <button type="submit">Join in</button>
          </div>
        </form>
      </div>
    </div>
  );
};
