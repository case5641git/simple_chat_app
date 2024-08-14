import React from "react";
import styles from "./styles.module.css";

type EditButtonProps = {
  onClick: () => void;
  alt: string;
  image: string;
};

export const EditButton: React.FC<EditButtonProps> = ({
  alt,
  image,
  onClick,
}) => {
  return (
    <img
      src={image}
      alt={alt}
      onClick={onClick}
      className={styles.edit_button}
    />
  );
};
