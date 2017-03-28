package com.dglproject.brand.adapters;

import android.content.Context;
import android.database.Cursor;
import android.support.v4.widget.CursorAdapter;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.dglproject.brand.R;
import com.dglproject.brand.database.HistoryContract;

/**
 * Created by Tortuvshin Byambaa on 3/7/2017.
 */

public class SearchAdapter extends CursorAdapter {

    public SearchAdapter(Context context, Cursor cursor, int flags) {
        super(context, cursor, 0);
    }

    @Override
    public View newView(Context context, Cursor cursor, ViewGroup parent) {
        return LayoutInflater.from(context).inflate(R.layout.search_view_list, parent, false);
    }

    @Override
    public void bindView(View view, Context context, Cursor cursor) {
        ListViewHolder vh = new ListViewHolder(view);
        view.setTag(vh);

        String text = cursor.getString(cursor.getColumnIndexOrThrow(HistoryContract.HistoryEntry.COLUMN_QUERY));

        boolean isHistory = cursor.getInt(cursor.getColumnIndexOrThrow(
                HistoryContract.HistoryEntry.COLUMN_IS_HISTORY)) != 0;

        vh.tv_content.setText(text);

        if (isHistory) {
            vh.iv_icon.setImageResource(R.drawable.ic_history_white);
        }
        else {
            vh.iv_icon.setImageResource(R.drawable.ic_action_search_white);
        }
    }

    @Override
    public Object getItem(int position) {
        String retString = "";

        // Move to position, get query
        Cursor cursor = getCursor();
        if(cursor.moveToPosition(position)) {
            retString = cursor.getString(cursor.getColumnIndexOrThrow(HistoryContract.HistoryEntry.COLUMN_QUERY));
        }

        return retString;
    }

    private class ListViewHolder {
        ImageView iv_icon;
        TextView tv_content;

        public ListViewHolder(View convertView) {
            iv_icon = (ImageView) convertView.findViewById(R.id.iv_icon);
            tv_content = (TextView) convertView.findViewById(R.id.tv_str);
        }
    }
}