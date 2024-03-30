import pandas as pd
import matplotlib.pyplot as plt

# pandasを使用してCSVファイルからデータを読み込む
df = pd.read_csv('your_survey_responses.csv')  # 'your_survey_responses.csv'は実際のファイル名に置き換えてください。

# 'はい' と 'いいえ' の回答の割合を集計する
# 'your_question_column'を実際の賛成/反対を尋ねる質問の列名に置き換えてください。
yes_no_counts = df['your_question_column'].value_counts()

# 円グラフを作成する
yes_no_counts.plot(kind='pie', autopct='%1.1f%%', startangle=140)
plt.axis('equal')  # 円グラフを完全な円にする
plt.title('賛成と反対の割合')
plt.show()
