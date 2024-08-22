import styles from "./styles.module.css";

type ListItemProps = {
  item: string;
  key: number;
  onClick?: () => void;
};

export const ListItem: React.FC<ListItemProps> = ({ item, key, onClick }) => {
  return (
    <li className={styles.listItem} onClick={onClick} key={key}>
      {item}
    </li>
  );
};
