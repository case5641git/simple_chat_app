import React from "react";
import styles from "./styles.module.css";
import { Title } from "../../atoms/Title";
import { EditButton } from "../../atoms/EditButton";

type SectionTitleProps = {
  title: string;
  image: string;
};

export const SectionTitle: React.FC<SectionTitleProps> = ({ title, image }) => {
  return (
    <div className={styles.title}>
      <Title title={title} />
      <EditButton image={image} />
    </div>
  );
};
