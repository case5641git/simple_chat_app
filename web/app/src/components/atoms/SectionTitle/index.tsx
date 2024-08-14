import React from "react";
import styles from "./styles.module.css";

type SectionTitleProps = {
  title: string;
};

export const SectionTitle: React.FC<SectionTitleProps> = ({ title }) => {
  return <div className={styles.title}>{title}</div>;
};
