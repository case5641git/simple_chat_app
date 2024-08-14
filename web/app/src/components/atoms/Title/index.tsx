import React from "react";
import styles from "./styles.module.css";

type TitleProps = {
  title: string;
};

export const Title: React.FC<TitleProps> = ({ title }) => {
  return <h1 className={styles.title}>{title}</h1>;
};
