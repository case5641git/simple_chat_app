import React, { useState } from "react";
import { ListItem } from "../../atoms/ListItem";
import styles from "./styles.module.css";

type MenuListProps = {
  onChangeId: (newChannelId: number) => void;
  onClick?: () => void;
};

type Items = {
  id: number;
  name: string;
}[];

export const MenuList: React.FC<MenuListProps> = ({ onChangeId, onClick }) => {
  const items: Items = [
    { id: 1, name: "Channel AAAAAAAAAAAAA" },
    { id: 2, name: "Channel B" },
    { id: 3, name: "Channel C" },
    { id: 4, name: "Channel D" },
    { id: 5, name: "Channel E" },
    { id: 6, name: "Channel F" },
    { id: 7, name: "Channel G" },
  ];

  return (
    <ul className={styles.itemList}>
      {items.map((item) => (
        <ListItem
          item={item.name}
          key={item.id}
          onClick={() => onChangeId(item.id)}
        />
      ))}
    </ul>
  );
};
