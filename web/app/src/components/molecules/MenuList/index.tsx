import React from "react";
import { ListItem } from "../../atoms/ListItem";
import styles from "./styles.module.css";

export const MenuList: React.FC = () => {
  const items = [
    "Channel AAAAAAAAAAAAA",
    "Channel B",
    "Channel C",
    "Channel D",
    "Channel E",
    "Channel F",
    "Channel G",
  ];
  return (
    <ul className={styles.itemList}>
      {items.map((item) => (
        <ListItem item={item} />
      ))}
    </ul>
  );
};
