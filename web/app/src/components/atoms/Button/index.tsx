import React from "react";
import styles from "./styles.module.css";

type ButtonProps = {
  onClick: () => void;
  text: string;
  type: "button" | "submit";
};

export const Button: React.FC<ButtonProps> = ({ onClick, text, type }) => {
  return (
    <button className={styles.edit_button} type={type} onClick={onClick}>
      {text}
    </button>
  );
};
