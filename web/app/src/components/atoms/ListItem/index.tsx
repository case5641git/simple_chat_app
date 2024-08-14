import styles from "./styles.module.css";

type ListItemProps = {
  item: string;
  onClick?: () => void;
};

export const ListItem: React.FC<ListItemProps> = ({ item, onClick }) => {
  return (
    <li className={styles.listItem} onClick={onClick}>
      {item}
    </li>
  );
};
