import styles from "./styles.module.css";

type ListItemProps = {
  item: string;
  itemId: number;
  onClick?: () => void;
};

export const ListItem: React.FC<ListItemProps> = ({
  item,
  itemId,
  onClick,
}) => {
  return (
    <li className={styles.listItem} onClick={onClick}>
      {item}
    </li>
  );
};
