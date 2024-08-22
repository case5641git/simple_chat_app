import React, { useState, FormEvent } from "react";
import { useNavigate } from "react-router-dom";
import styles from "./styles.module.css";
import { Title } from "../../components/atoms/Title";
import axios from "axios";

type User = {
  id: number;
  name: string;
  email: string;
};

type LoginResponse = {
  token: string;
};

export const Login: React.FC = () => {
  const [user, setUser] = useState<User | null>(null);
  const [loading, setLoading] = useState<boolean>(true);
  const [email, setEmail] = useState<string>("");
  const [password, setPassword] = useState<string>("");
  const [error, setError] = useState<string | null>(null);
  const [success, setSuccess] = useState<boolean>(false);
  const navigate = useNavigate();

  const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    ?.getAttribute("content");

  const url = "http://localhost:8000/api/login";

  const handleChangeEmail = (e: React.ChangeEvent<HTMLInputElement>) => {
    setEmail(e.target.value);
  };

  const handleChangePassword = (e: React.ChangeEvent<HTMLInputElement>) => {
    setPassword(e.target.value);
  };

  const csrfTokenUrl = "http://localhost:8000/sanctum/csrf-cookie";

  const handleSubmit = async (event: FormEvent) => {
    event.preventDefault();
    try {
      await axios.get(csrfTokenUrl, { withCredentials: true });

      const response = await axios.post<LoginResponse>(
        url,
        {
          email: email,
          password: password,
        },
        {
          withCredentials: true,
        }
      );

      localStorage.setItem("token", response.data.token);
      console.log(response);
      navigate("/");
    } catch (error) {
      console.log(error);
      setError("ログインに失敗しました。");
    }
  };

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
        <form onSubmit={handleSubmit}>
          <div className={styles.inputBox}>
            <label htmlFor="">Email</label>
            <input type="text" value={email} onChange={handleChangeEmail} />
          </div>
          <div className={styles.inputBox}>
            <label htmlFor="">Password</label>
            <input
              type="text"
              value={password}
              onChange={handleChangePassword}
            />
          </div>
          <div className={styles.submitButton}>
            <button type="submit">Login</button>
          </div>
        </form>
      </div>
    </div>
  );
};
